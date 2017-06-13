@extends('layouts.app')

@section('content')

    @foreach($categories as $category_name => $benefits)
    <div class="panel panel-default benefit-category">
        <div class="panel-heading">{{ $category_name }}</div>
        <div class="panel-body">
            <div class="row">
                @foreach($benefits as $benefit)
                <div class="col-md-9">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    {{ $benefit->name }}
                </div>
                <div class="col-md-3 price">
                    {{ $benefit->coverage }}
                </div>
                @endforeach
            </div>
      </div>
    </div>

    @endforeach

    <button onclick="window.history.back()" class="btn btn-warning" style="margin-top: 20px;"><< Voltar</button>

    <div style="height: 300px;">
    </div>

    <div id="resumo-compra">
        <h2>Resumo da sua compra</h2>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                            Seguradora: {{ $provider }}
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                            Destino: {{ $destination_name }}
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                            Idade: limite de {{ $min_max_age }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            Início: {{ date('d/m/Y', strtotime($departure)) }}
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            Término: {{ date('d/m/Y', strtotime($return)) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <?php

                $params = [
                    'id' => $product_code,
                    'destination' => $destination_slug,
                    'begin_date' => $departure,
                    'end_date' => $return
                ];

                ?>

                <div>
                    <p id="adult-price"><span>R$</span>{{ $adult_price }}</p>
                    <a href="{{ route('purchases.create', $params) }}" class="btn btn-lg btn-warning">Comprar</a>
                </div>

            </div>

        </div>
    </div>



@endsection
