@extends('layouts.admin')
@section('container')

<h1 class="text-center">Cadastrar Novo Pedido</h1>

<form action="/order">
    @csrf
    <div class="form-goup">
        <div class="card border-primary p-2 mb-3">
            <label for="customer">Nome do Cliente</label>
            <input class="form-control" type="text" name="name" required id="customer">

            <label for="phone">Telefone</label>
            <input class="form-control" type="number" name="phone" required id="phone">

            <label for="">Data</label>
            <input type="date" name="date" class="form-control">

            <label for="">Cep</label>
            <input type="text" name="zipcode" id="cep" required class="form-control" onblur="searchCep(this.value)"/>

            <input type="hidden" name="coords" id="coords" class="form-control" />

            <label for="">Endereço</label>
            <input type="text" name="street_name" id="rua" required class="form-control">

            <label for="">Número</label>
            <input type="text" name="street_number" id="numero" required onfocus="searchCoords()"  class="form-control">

            <label for="">Bairro</label>
            <input type="text" name="district" id="bairro" required class="form-control">

            <label for="">Cidade</label>
            <input type="text" name="city" id="cidade" required class="form-control">

            <label for="">Estado</label>
            <input type="text" name="state" id="uf" required class="form-control">

            <label for="">Status do pedido</label>
            <input type="text" name="status" id="status" required class="form-control">

            <label for="">Valor do pedido</label>
            <input type="text" name="amount" id="amount" required class="form-control">

            <label for="">Observações</label>
            <textarea name="details" id="details" cols="10" rows="2" class="form-control"></textarea>

        </div>
    </div>
    <input class="btn m-2" style="background-color: #FB6090; color:#fff;" type="submit" value="Cadastrar pedido">
</form>

<script>
    let coord = document.getElementById('coords');
    let lat;
    let lng;

    async function searchCoords() {
        //Função para buscar as coordenadas a partir do cep
        let cep = document.getElementById('cep').value;
        if (cep) {
            let response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cep}&key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY`);

            let coords = await response.json();

            lat = Number(coords.results[0].geometry.location.lat);
            lng = Number(coords.results[0].geometry.location.lng);

            coord.value = `{lat: ${lat}, lng: ${lng}}`
            console.log(coord)
        }
    }
</script>

@endsection