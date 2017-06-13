<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
     * Procurar benefícios em uma lista pelo código do benefício
     *
     * @param array $selug Slug do destino
     */
    protected function getDestinationName($selug) {

        $destinationsList = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/additional-info/destinations');
        $destinationsList = json_decode($destinationsList);

        //Altera despesas médicas
        foreach ($destinationsList as $destination) {

            if($destination->slug == $selug) {
                return $destination->name;
            }

        }

    }



    /**
     * Helper para fazer requisições na api
     * @param string $url Endereço da requisição
     * @param array $postData Dados para serem enviados - Somente requisições POST
     */
    protected function requestApi($url, $postData = null)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json. charset=utf-8'));
        curl_setopt($ch, CURLOPT_USERPWD, 'illager:evoker@111');

        if($postData !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($ch);

    }


    /**
     * Procurar benefícios em uma lista pelo código do benefício
     *
     * @param array $benefitsList Lista de benefícios que será usada
     * @param array $findBenefits Códigos dos benefícios para procurar
     */
    protected function findBenefits(array $benefitsList, array $findBenefits) {

        $benefits = [];

        //Altera despesas médicas
        foreach ($benefitsList as $benefit) {

            if(in_array($benefit->code, $findBenefits)) {

                $index = array_search($benefit->code, $findBenefits);
                $elem = array_splice($findBenefits, $index, 1);

                $benefits[$benefit->code] = $benefit;
            }

            if(empty($findBenefits)) return $benefits;

        }

    }

    /**
     * Calcula dias entre 2 datas
     */
    protected function calculateDays($begin_date, $end_date) {

        $begin_date = new \DateTime($begin_date);
        $end_date = new \DateTime($end_date);

        return $begin_date->diff($end_date)->days + 1;

    }

    /**
     * Converte data para o formato yyyy-mm-dd
     */
    protected function dateToTimestamp($date) {

        $dateArray = explode('/', $date);

        return $dateArray[2].'-'.$dateArray[1].'-'.$dateArray[0];

    }

    /**
     * Retira tudo que não é número
     */
    protected function clearNumber($number) {
        return preg_replace('/[^0-9]/', '', $number);
    }

}
