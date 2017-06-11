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

    <div class="content" style="margin-left: 20px; margin-right: 20px;">
    @yield('content')
    </div>

    @include('layouts.footer')


    <!-- jQuery -->
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendor/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('vendor/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/jqueryui/datepicker-pt-BR.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


</body>

</html>
