<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegurosController extends Controller
{
    public function index()
    {

        $destinations = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/additional-info/destinations');

        return view('seguros/index', [
            'destinations' => json_decode($destinations)
        ]);

    }

    public function quotation(Request $request)
    {


        // 'destination' => $request->input('destination'),
        // 'begin_date' => $request->input('begin_date'),
        // 'end_date' => $request->input('end_date'),
        // 'name' => $request->input('name'),
        // 'email' => $request->input('email'),
        // 'cellphone' => $request->input('cellphone')


        $postData = [
            'destination' => $request->input('destination'),
            'begin_date' => $request->input('begin_date'),
            'end_date' => $request->input('end_date')
        ];


        $response = $this->requestApi('http://staging.segurospromo.com.br/emitir-seguros/v0/quotations', json_encode($postData));


        dd(json_decode($response));


    }

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
