<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\PurchaseContact;
use App\Insured;
use App\Purchase;
use App\Creditcard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PurchasesController extends Controller
{

    public function create()
    {

        $params = Route::current()->parameters();

        $id = $params['id'];
        $destination = $params['destination'];
        $begin_date = $params['begin_date'];
        $end_date = $params['end_date'];

        $postData = [
            'product_code' => $id,
            'destination' => $destination,
            'begin_date' => $begin_date,
            'end_date' => $end_date
        ];

        $product = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));
        $product = json_decode($product);


        $productDetails = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/products/'.$id);
        $productDetails = json_decode($productDetails);


        //Procuro pelos benefícios de código 50 (Despesa Médica Hospitalar Total) e 42 (Seguro bagagem)
        $benefitsFound = $this->findBenefits($productDetails->benefits, array('50', '42'));

        $total_days = $this->calculateDays($begin_date, $end_date);
        $price_day = $product[0]->adult->price / $total_days;

        $destination_name = $this->getDestinationName($destination);

        return view('purchases/create', [
            'product_code' => $product[0]->code,
            'provider' => $product[0]->provider_name,
            'plan' => $productDetails->name,
            'destination_slug' => $destination,
            'destination_name' => $destination_name,
            'begin_coverage' => $begin_date,
            'end_coverage' => $end_date,
            'price_day' => $price_day,
            'min_max_age' => $product[0]->adult->min_age.' a '.$product[0]->adult->max_age.' anos',
            'medical_expense' => $benefitsFound[50]->coverage,
            'baggage_insurance' => $benefitsFound[42]->coverage,
            'price_adult' => $product[0]->adult->price
        ]);

    }


    public function store(Request $request) {

        $product_code = $request->input('product_code');

        $postData = [
            'product_code' => $product_code,
            'destination' => $request->input('destination'),
            'begin_date' => $request->input('begin_coverage'),
            'end_date' => $request->input('end_coverage'),
        ];

        $quotation = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));
        $quotation = json_decode($quotation);

        $product = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/products/'.$request->input('product_code'));
        $product = json_decode($product);


        //Pedido
        $dataPurchase = [
            'product_code' => $request->input('product_code'),
            'destination' => $request->input('destination'),
            'coverage_begin' => $request->input('begin_coverage'),
            'coverage_end' => $request->input('end_coverage'),
            'payment_method' => $request->input('payment_method'),
            'price' => $quotation[0]->adult->price,
            'parcels' => 1,
            'holder_name' => $request->input('creditcard_name'),
            'holder_cpf' => $request->input('creditcard_document')
        ];


        //Segurados
        $dataInsureds = [];

        $count = 0;

        while($request->input('full_name-'.$count) != null) {

            $dataInsureds[] = [
                'document' => $request->input('document-'.$count),
                'document_type' => 'CPF',
                'full_name' => $request->input('full_name-'.$count),
                'birth_date' => $this->dateToTimestamp($request->input('birth_date-'.$count))
            ];

            $count++;
        }


        //Cartão de crédito
        $dataCreditcard = [
            'expiration_year' => $request->input('creditcard_expiration_year'),
            'expiration_month' => $request->input('creditcard_expiration_month'),
            'cvv' => $request->input('creditcard_cvv'),
            'brand' => 'visa',
            'number' => $this->clearNumber($request->input('creditcard_number')),
        ];

        //Dados contato da compra
        $dataPurchaseContact = [
            'full_name' => $request->input('contact_name'),
            'email' => $request->input('contact_phone'),
            'phone' => '1233',
        ];


        $return = null;


        DB::beginTransaction();

        try {

            $purchase = Purchase::create($dataPurchase);


            $insuredsRepository = [];

            //Segurados
            foreach ($dataInsureds as $insured) {

                $insured['purchases_id'] = $purchase->id;
                $insuredsRepository[] = Insured::create($insured);

            }

            $dataCreditcard['purchases_id'] = $purchase->id;
            Creditcard::create($dataCreditcard);

            $dataPurchaseContact['purchases_id'] = $purchase->id;
            PurchaseContact::create($dataPurchaseContact);


            //Dados para cadastro na api
            $dataPurchaseApi = [
                'merchant_purchase_id' => (string) $purchase->id,
                'product_code' => $request->input('product_code'),
                'destination' => $request->input('destination'),
                'coverage_begin' => $request->input('begin_coverage'),
                'coverage_end' => $request->input('end_coverage'),
                'payment_method' => $request->input('payment_method'),
                'price' => ($quotation[0]->adult->price * count($dataInsureds)),
                'parcels' => 1,
                'holder' => [
                    'full_name' => $request->input('creditcard_name'),
                    'cpf' => $this->clearNumber($request->input('creditcard_document'))
                ],
                'insureds' => [],
                'creditcard' => [
                    'expiration_year' => $request->input('creditcard_expiration_year'),
                    'expiration_month' => $request->input('creditcard_expiration_month'),
                    'cvv' => $request->input('creditcard_expiration_month'),
                    'brand' => $request->input('brand_name'),
                    'number' => $this->clearNumber($request->input('creditcard_number'))
                ]
            ];

            foreach ($insuredsRepository as $insured) {
                $dataPurchaseApi['insureds'][] = [
                    'merchant_insured_id' => (string) $insured->id,
                    'document' => $insured->document,
                    'document_type' => $insured->document_type,
                    'full_name' => $insured->full_name,
                    'birth_date' => $insured->birth_date
                ];
            }

            $return = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/purchases', json_encode($dataPurchaseApi));


            //Lança uma exceção caso ocorrar algum erro ao salvar na api
            if(preg_match('/error/', $return) != false) {
                throw new \Exception('Erro ao gravar na api');
            }

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollback();

            //Redireciona para página de finalização sinalizando que houve erro
            return redirect()->route('purchases.end', ['status' => 'error']);

        }

        //Redireciona para página de finalização sinalizando que a compra
        //foi realizada com sucesso
        return redirect()->route('purchases.end', ['status' => 'success']);

    }

    public function end() {
        return view('purchases/end');
    }


}
