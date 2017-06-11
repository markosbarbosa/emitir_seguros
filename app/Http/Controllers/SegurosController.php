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

}
