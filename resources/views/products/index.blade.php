@extends('layouts.app')

@section('content')

<h2>Encontre abaixo as melhores opções de seguro viagem para:</h2>


<div id="info-basic" class="row">
    <div class="col-md-3">
        <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
        Destino: {{ $destination }}
    </div>
    <div class="col-md-3">
        <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
        Total de dias: {{ $total_days }}
    </div>
    <div class="col-md-3">
        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
        Saída: {{ date('d/m/Y', strtotime($departure)) }}
    </div>
    <div class="col-md-3">
        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
        Retorno: {{ date('d/m/Y', strtotime($return)) }}
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Seguradora</th>
            <th>Plano</th>
            <th>Despesa médica hospitalar total</th>
            <th>Seguro bagagem</th>
            <th>Total por segurado</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <th scope="row">{{ $product['provider_name'] }}</th>
            <td>{{ $product['plan'] }}</td>
            <td>{{ $product['medical_expense'] }}</td>
            <td>{{ $product['luggage_insurance'] }}</td>
            <td>{{ $product['adult_price'] }}</td>

            <?php

            $product_code = $product['product_code'];
            $params = [
                'id' => $product_code,
                'destination' => $destination,
                'begin_date' => $departure,
                'end_date' => $return
            ];

            ?>

            <td><a href="{{ route('products.show', $params) }}" class="btn btn-success">Selecionar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<button onclick="window.history.back()" class="btn btn-warning"><< Voltar</button>

@endsection
