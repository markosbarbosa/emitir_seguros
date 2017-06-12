@extends('layouts.app')

@section('content')

<?php $status = app('request')->input('status') ?>

@if($status == 'error')

<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  Ocorreu algum erro. Tente novamente!
</div>
@endif

@if($status == 'success')

<div class="alert alert-success" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Success:</span>
  Compra realizada com sucesso!
</div>
@endif



@endsection
