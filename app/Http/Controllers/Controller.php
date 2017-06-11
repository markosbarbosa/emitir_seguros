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
}
