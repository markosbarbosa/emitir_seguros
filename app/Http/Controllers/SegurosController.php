<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Route;

class SegurosController extends Controller
{
    public function index()
    {

        $destinations = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/additional-info/destinations');

        return view('seguros/index', [
            'destinations' => json_decode($destinations)
        ]);

    }

    public function productShow(Request $request, $id) {

        $response = $this->requestApi('staging.segurospromo.com.br/emitir-seguros/v0/products/'.$id);

        $productDetails = json_decode($response);


        $byCategory = [];


        foreach ($productDetails->benefits as $benefit) {
            $byCategory[$benefit->category_name][] = $benefit;
        }

        session_start();
        $destination = $_SESSION['purchase']['destination'];
        $departure = $_SESSION['purchase']['departure'];
        $return = $_SESSION['purchase']['return'];
        session_write_close();

        return view('seguros/product_show', [
            'provider' => $productDetails->provider_name,
            'destination' => $destination,
            'departure' => $departure,
            'return' => $return,
            'categories' => $byCategory
        ]);

    }

    public function products(Request $request)
    {

        $params = Route::current()->parameters();


        $postData = [
            'destination' => $params['destination'],
            'begin_date' => $params['begin_date'],
            'end_date' => $params['end_date']
        ];


        $response = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));

        $products = $this->infoProducts(json_decode($response));


        $begin_date = new \DateTime($params['begin_date']);
        $end_date = new \DateTime($params['end_date']);

        //Guarda informações na sessão
        //para ser recuperada em outra página
        session_start();
        $_SESSION['purchase'] = [
            'destination' => $params['destination'],
            'departure' => $begin_date->format('d/m/Y'),
            'return' => $end_date->format('d/m/Y')
        ];
        session_write_close();


        return view('seguros/products', [
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
    private function infoProducts($listProducts) {

        $products = [];

        foreach ($listProducts as $product) {

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


    /**
     * Helper para fazer requisições na api
     * @param string $url Endereço da requisição
     * @param array $postData Dados para serem enviados - Somente requisições POST
     */
    private function requestApi($url, $postData = null) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json. charset=utf-8'));
        curl_setopt($ch, CURLOPT_USERPWD, 'illager:evoker@111');

        if($postData !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($ch);

    }



}
