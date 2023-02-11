@extends('layouts.admin')
@section('container')

<h1 class="text-center">Seja bem vindo ao Sistema de gerenciamento de pedidos</h1>
<div class="alert alert-info" role="alert">
	Clique <a href="/orders/create">aqui</a>  para cadastrar um novo pedido
</div>
<div style="border: 2px solid black; width: 80%; display:flex; justify-content: center;margin: auto;">
    <img src="/img/bg.jpg" alt="imagem de cookie" style="width: 100%;">
</div>

@endsection