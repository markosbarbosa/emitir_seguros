<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Emitir Seguros</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('vendor/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('vendor/jqueryui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jqueryui/jquery-ui.theme.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">Emitir Seguros</a>
        </div>
    </div>
</nav>

    <!-- Header -->
        <div class="container" id="maincontent" tabindex="-1">

            <div class="row" style="text-align: left">
                <div class="form-group col-md-6">
                    <select id="testeinput2" class="form-control">
                        <option>-- Selecione o destino --</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 datepicker">
                    <div class="input-group">
                        <input type="text" placeholder="Partida" class="form-control date">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" aria-label="Help">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <div class="input-group">
                        <input type="text" placeholder="Partida" class="form-control date">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default" aria-label="Help">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @include('layouts.footer')


    <!-- jQuery -->
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendor/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('vendor/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>





</body>

</html>
