@extends('layouts.admin')
@section('container')

<form class="form-inline my-2 my-lg-0" method="GET" action="/orders">
	<input class="form-control mr-sm-2" type="search" placeholder="Procurar pedido" aria-label="Search" name="search">
	<button class="btn my-2 my-sm-0" style="background-color: #FB6090; color:#fff;" type="submit">Pesquisar</button>
</form>

@if($search)
<h1 class="text-center">Buscando por pedido: {{ $search }}</h1>
@else
<h1 class="text-center">Lista de Pedidos</h1>
@endif

@if(count($orders) > 0)
<form action="/orders/export/" method="GET">
	<input class="btn m-2" style="background-color: #FB6090; color:#fff;" type="submit" value="Fazer download da planilha de pedidos">
</form>

@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nome</th>
			<th scope="col">Telefone</th>
			<th scope="col">Data do pedido</th>
			<th scope="col">Endereço</th>
			<th scope="col">Status</th>
			<th scope="col">Valor</th>
			<th scope="col">Detalhes do pedido</th>
			<th scope="col"> Editar </th>
			<th scope="col"> Deletar </th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $order)
		<tr>
			<th scope="row">{{ $order->id }}</th>
			<td>{{ $order->name }}</td>
			<td>{{ $order->phone }} </td>
			<td>{{ $order->date }}</td>
			<td>{{ $order->street_name }}, {{ $order->street_number }} - {{ $order->district }}</td>
			<td>{{ $order->status }}</td>
			<td>R$ {{ $order->amount }}</td>
			<td>{{ $order->details }}</td>
			<td><a href="/order/edit/{{ $order->id }}"><input class="btn btn-primary" type="reset" value="Editar"></a></td>
			<td>
				<form action="/order/destroy/{{ $order->id }}" method="POST">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger delete-btn">Deletar</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@if(count($orders) == 0 && $search)
<div class="alert alert-info" role="alert">
	Não há pedidos cadastrados com esse nome! <a href="/orders">Ver todos</a>
</div>
@elseif(count($orders) == 0)
<div class="alert alert-info" role="alert">
	Não há pedidos cadastrados
</div>
@endif

@endsection