@extends('layouts.admin')
@section('container')

<h1 class="text-center">Cadastrar Novo Pedido</h1>

<form action="/order/update/{{ $order->id }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-goup w-50">
        <div class="card border-primary p-2 mb-3">
            <label for="customer">Nome do Cliente</label>
            <input class="form-control" type="text" name="name" id="customer" value="{{ $order->name }}">

            <label for="phone">Telefone</label>
            <input class="form-control" type="number" name="phone" id="phone" value="{{ $order->phone }}">

            <label for="">Data</label>
            <input type="date" name="date" class="form-control" value="{{ $order->date }}">

            <label for="">Cep</label>
            <input type="number" name="zipcode" id="cep" class="form-control"  value="{{ $order->zipcode }}" />

            <label for="">Endereço</label>
            <input type="text" name="street_name" id="rua" class="form-control" value="{{ $order->street_name }}">

            <label for="">Número</label>
            <input type="text" name="street_number" id="numero" class="form-control" value="{{ $order->street_number }}">

            <label for="">Bairro</label>
            <input type="text" name="district" id="bairro" class="form-control" value="{{ $order->district }}">

            <label for="">Cidade</label>
            <input type="text" name="city" id="cidade" class="form-control" value="{{ $order->city }}">

            <label for="">Estado</label>
            <input type="text" name="state" id="uf" class="form-control" value="{{ $order->state }}">

            <label for="">Status do pedido</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}">

            <label for="">Valor do pedido</label>
            <input type="text" name="amount" id="amount" class="form-control" value="{{ $order->amount }}">

            <label for="">Observações</label>
            <textarea name="details" id="details" cols="10" rows="2" class="form-control"><?php echo trim($order->details); ?></textarea>

        </div>
    </div>
    <input class="btn btn-primary m-2" type="submit" value="Atualizar pedido">
</form>

@endsection