@extends('layouts.app')

@section('content')
<div class="container" id="maincontent" tabindex="-1">
    <form id="search_products">
        <div class="row" style="text-align: left">
            <div class="form-group col-md-6">
                <select id="destination" class="form-control" required>
                    <option value="">-- Selecione o destino --</option>
                    @foreach($destinations as $destination)
                    <option value="{{ $destination->slug }}">{{ $destination->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <input type="text" id="name" placeholder="Nome completo" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3 datepicker">
                <div class="input-group">
                    <input type="text" id="begin_date" placeholder="Partida" class="form-control date" required>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" aria-label="Help">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="input-group">
                    <input type="text" id="end_date" placeholder="Partida" class="form-control date" required>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default" aria-label="Help">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-3">
                <input type="text" id="email" placeholder="E-mail" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
                <input type="text" id="cellphone" placeholder="Celular" class="form-control" required>
            </div>

        </div>


        <button class="btn btn-default">Pesquisar</button>
    </form>
</div>
@endsection
