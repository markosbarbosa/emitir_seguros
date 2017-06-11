<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;

class ProductsController extends Controller
{


    public function show(Request $request, $id)
    {

        //Lendo informações da sessão
        session_start();
        $destination = $_SESSION['purchase']['destination'];
        $beginDate = $_SESSION['purchase']['begin_date'];
        $endDate = $_SESSION['purchase']['end_date'];
        session_write_close();

        $postData = [
            'product_code' => $id,
            'begin_date' => $beginDate,
            'end_date' => $endDate,
            'destination' => $destination
        ];

        //Dados do produto selecionado
        $response = $this->requestApi('staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));
        $product = json_decode($response);

        //Detalhes do produto
        $response = $this->requestApi('staging.segurospromo.com.br/emitir-seguros/v0/products/'.$id);

        $productDetails = json_decode($response);

        $byCategory = [];


        foreach ($productDetails->benefits as $benefit) {
            $byCategory[$benefit->category_name][] = $benefit;
        }

        $departureDate = new \DateTime($beginDate);
        $returnDate = new \DateTime($endDate);

        return view('products/show', [
            'adult_price' => number_format($product[0]->adult->price, 2, ',', '.'),
            'min_max_age' => $product[0]->adult->min_age.' a '.$product[0]->adult->max_age.' anos',
            'provider' => $productDetails->provider_name,
            'destination' => $destination,
            'departure' => $departureDate->format('d/m/Y'),
            'return' => $returnDate->format('d/m/Y'),
            'categories' => $byCategory
        ]);

    }

    public function index(Request $request)
    {

        $params = Route::current()->parameters();

        $postData = [
            'destination' => $params['destination'],
            'begin_date' => $params['begin_date'],
            'end_date' => $params['end_date']
        ];


        $response = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));

        $productsList = json_decode($response);

        $products = $this->infoProducts($productsList);


        $begin_date = new \DateTime($params['begin_date']);
        $end_date = new \DateTime($params['end_date']);

        //Guarda informações na sessão
        //para ser recuperada em outra página
        session_start();
        $_SESSION['purchase'] = [
            'destination' => $params['destination'],
            'begin_date' => $begin_date->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d')
        ];
        session_write_close();


        return view('products/index', [
            'destination' => $params['destination'],
            'total_days' => ($begin_date->diff($end_date)->days + 1),
            'departure' => $begin_date->format('d/m/Y'),
            'return' => $end_date->format('d/m/Y'),
            'products' => $products
        ]);

    }



    /**
     * Busca informaçẽs detalhadas de cada produto
     * @param array $listQuotations Lista de cotações
     */
    private function infoProducts($productsList)
    {

        $products = [];

        foreach ($productsList as $product) {

            $response = $this->requestApi('staging.segurospromo.com.br/emitir-seguros/v0/products/'.$product->code);

            $details = json_decode($response);


            $foundHealthCare = false;
            $foundLuggageInsurance = false;

            $priceHealthCare = null;
            $priceLuggageInsurance = null;


            //Altera despesas médicas
            foreach ($details->benefits as $benefit) {

                //Se encontrou cobertura de assistência médica
                if($benefit->code == 50) {
                    $foundHealthCare = true;
                    $priceHealthCare = $benefit->coverage;
                }

                //Se encontrou a cobertura do seguro bagagem
                if($benefit->code == 42) {
                    $foundLuggageInsurance = true;
                    $priceLuggageInsurance = $benefit->coverage;
                }


                //Interrompe o loop se já encontrou o preço
                //da assistência médica e do seguro bagagem
                if($foundHealthCare && $foundLuggageInsurance) {
                    break;
                }

            }


            $products[] = [
                'product_code' => $product->code,
                'adult_price' => 'R$ '.number_format($product->adult->price, 2, ',', '.'),
                'provider_name' => $details->provider_name,
                'plan' => $details->name,
                'medical_expense' => $priceHealthCare,
                'luggage_insurance' => $priceLuggageInsurance
            ];


        }

        return $products;

    }


}
