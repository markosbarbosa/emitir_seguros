@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-8">

        <form id="purchase-form" action="{{ route('purchases.store') }}" method="post">

            <!-- token para garantir que a requisição está vindo do próprio servidor -->
            {{ csrf_field() }}

            <input type="hidden" name="product_code" value="{{ $product_code }}">
            <input type="hidden" name="destination" value="{{ $destination }}">
            <input type="hidden" name="begin_coverage" value="{{ $begin_coverage }}">
            <input type="hidden" name="end_coverage" value="{{ $end_coverage }}">
            <input type="hidden" id="brand_name" name="brand_name" value="teste">

            <!-- Dados dos segurados -->
            <div class="panel panel-default">
                <div class="panel-heading">Segurados</div>
                <div class="panel-body">

                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="full_name-0">Nome completo</label>
                                    <input type="text" id="full_name-0" name="full_name-0" class="form-control" placeholder="Nome do segurado" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="birth_date-0">Nascimento</label>
                                    <input type="text" id="birth_date-0" name="birth_date-0" class="form-control" placeholder="Nascimento" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document-0">CPF</label>
                                    <input type="text" id="document-0" name="document-0" class="form-control" placeholder="Documento do segurado" required>
                                </div>
                            </div>
                        </div>


                    <hr>

                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    <a href="#">Adicionar segurados</a>

                </div>
            </div>

            <!-- Forma de pagamento -->
            <div class="panel panel-default">
                <div class="panel-heading">Forma de pagamento</div>
                <div class="panel-body">

                    <label class="radio-inline">
                        <input type="radio" name="payment_method" id="payment_method" value="creditcard" checked>
                        Cartão de crédito
                    </label>

                </div>
            </div>

            <!-- Dados do cartão -->
            <div class="panel panel-default">
                <div class="panel-heading">Dados do cartão</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-8">
                            <label for="creditcard_name">Nome</label>
                            <input type="text" class="form-control" id="creditcard_name" name="creditcard_name" placeholder="Nome" required>
                        </div>
                        <div class="col-md-4">
                            <label for="creditcard_document">CPF</label>
                            <input type="text" class="form-control" id="creditcard_document" name="creditcard_document" placeholder="CPF" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="creditcard_number">Número do cartão</label>
                            <input type="text" id="creditcard_number" name="creditcard_number" class="form-control card-number" placeholder="Número do cartão" required>
                        </div>
                        <div class="col-md-2">
                            <label for="creditcard_expiration_month">Mês validade</label>
                            <select id="creditcard_expiration_month" name="creditcard_expiration_month" class="form-control" required>
                                <option vlaue="">---</option>
                                @foreach(range(1, 12) as $month)
                                <option vlaue="{{ $month }}">{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="creditcard_expiration_year">Ano validade</label>
                            <select id="creditcard_expiration_year" name="creditcard_expiration_year" class="form-control" required>
                                <option vlaue="">---</option>
                                <?php $ano_atual = date('Y') ?>
                                @foreach(range($ano_atual, $ano_atual + 14) as $year)
                                <option vlaue="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="creditcard_cvv">CVV</label>
                            <input type="text" id="creditcard_cvv" name="creditcard_cvv" class="form-control" placeholder="CVV" required>
                        </div>
                    </div>

                </div>
            </div>


            <!-- Dados do contato da compra -->
            <div class="panel panel-default">
                <div class="panel-heading">Dados do contato da compra</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="contact_name">Nome</label>
                            <input type="text" id="contact_name" name="contact_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="contact_email">E-mail</label>
                            <input type="text" id="contact_email" name="contact_email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_phone">Telefone</label>
                            <input type="text" id="contact_phone" name="contact_phone" class="form-control" required>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group" style="margin-bottom: 100px;">
                    <button onclick="window.history.back()" class="btn btn-warning"><< Voltar</button>
                    <button type="submit" class="btn btn-success" class="form-control">Efetuar Pagamento</button>
                </div>
            </div>

        </form>


    </div>
    <div class="col-md-4">

        <div class="panel panel-default">
            <div class="panel-heading">Resumo da Viagem</div>
            <div class="panel-body">
                <ul class="topics">
                    <li>
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        Seguradora: {{ $provider }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        Plano: {{ $plan }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                        Destino: {{ $destination }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        Início cobertura: {{ $plan }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        Fim cobertura: {{ $begin_coverage }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                        Investimento por dia: {{ $end_coverage }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                        Idade: limite de {{ $min_max_age }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        Despesa médica Hospitalar total: {{ $medical_expense }}
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                        Seguro de bagagem extraviada: {{ $baggage_insurance }}
                    </li>
                </ul>

                <hr>

                <div id="total-order">
                    <div id="left">Valor total </div><div id="right">{{ $total }}</div>
                </div>


            </div>
        </div>

    </div>

</div>



@endsection
