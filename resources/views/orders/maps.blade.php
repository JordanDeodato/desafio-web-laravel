@extends('layouts.admin')
@section('container')

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY&callback=initMap&v=weekly" defer></script>

<main>
    @if($search)
    <h1 class="text-center">Buscando por pedidos no bairro de: {{ $search }}</h1>
    @elseif($data_inicio && $data_fim)
    <h1 class="text-center">Buscando por pedidos entre: {{ $data_inicio }} e {{ $data_fim }}</h1>
    @else
    <h1 class="text-center">Localização dos Pedidos Realizados</h1>
    @endif

    @if(count($orders) == 0 && $search)
    <div class="alert alert-info" role="alert">
        Nenhum pedido foi realizado para esse bairro! <a href="/orders">Ver todos</a>
    </div>
    @elseif(count($orders) == 0)
    <div class="alert alert-info" role="alert">
        Não há pedidos cadastrados
    </div>
    @endif

    <label for="filter">Filtrar por:</label>
    <select class="form-select" name="filter" id="filter">
        <option>Escolha um filtro</option>
        <option value="Por Data">Por Data</option>
        <option id="district" value="Por Bairro">Por Bairro</option>
    </select>

    @if($search || $data_inicio || $data_fim)
    <input onclick="cleanFilter()" class="btn m-2" style="background-color: #FB6090; color:#fff;" type="submit" value="Limpar Filtros">
    @endif

    <form id="searchDistrict" class="form-inline my-2 my-lg-0" method="GET" action="/orders/maps">
        <input class="form-control" type="text" name="search" id="search" placeholder="Digite um bairro">
        <input class="btn m-2" style="background-color: #FB6090; color:#fff;" type="submit" name="Filtrar" value="Filtrar">
    </form>

    <form id="searchLast" class="form-inline my-2 my-lg-0" method="GET" action="/orders/maps">
        <input class="form-control" type="date" name="data_inicio" id="data_inicio" placeholder="Digite uma data inicial">
        <input class="form-control" type="date" name="data_fim" id="data_fim" placeholder="Digite uma data final">
        <input class="btn m-2" style="background-color: #FB6090; color:#fff;" type="submit" name="Filtrar" value="Filtrar">
    </form>

    <div id="map" style="height: 500px;"></div>

</main>

<script>
    $(document).ready(function() {
        $('#searchDistrict').hide();
        $('#searchLast').hide();

        $('#filter').change(function() {

            if ($('#filter').val() == 'Por Bairro') {
                $('#searchDistrict').show();
            } else {
                $('#searchDistrict').hide();
            }
            if ($('#filter').val() == 'Por Data') {
                $('#searchLast').show();
            } else {
                $('#searchLast').hide();
            }
        })
    });

    function cleanFilter() {
        return window.location.href = "/orders/maps";
    }

    var points = [<?php foreach ($orders as $order) {
                        echo ($order->coords) . ',';
                    } ?>]; //Salvando as coordenadas obtidas do banco
    var markers = []; //Inserindo os marcadores
    var map;

    function habilitMarker() {
        $.each(points, function(key, point) {
            var position = new google.maps.LatLng(point.lat, point.lng);

            var marker = new google.maps.Marker({
                position: position,
                map: map,
                title: "Pedido " + (key + 1)
            });

            markers.push(marker);
        })
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -7.121268,
                lng: -34.880279
            },
            zoom: 8,
        });

        habilitMarker();
    }

    window.initMap() = initMap();
</script>

@endsection