@extends('layouts.admin')
@section('container')

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY&callback=initMap&v=weekly" defer></script>

<div id="map" style="height: 500px;"></div>

<script>    
    
    var ceps = [<?php foreach($orders as $order) {echo intval($order->zipcode) . ',';} ?>]; //Consultando os ceps do Banco de dados
    var points = []; //Salvando as coordenadas obtidas através do cep
    var markers = []; //Inserindo os marcadores
    var map;

    (function searchCep() {
        //Função para buscar as coordenadas a partir do cep

        ceps.forEach(async (cep)=>{
            let response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cep}&key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY`);
            let coords = await response.json();
            lat = Number(coords.results[0].geometry.location.lat);
            lng = Number(coords.results[0].geometry.location.lng);

            let coord = {lat: lat, lng: lng};
            points.push(coord);
        });          
    })

    function habilitarMarker() {
        $.each(points, function(key, point) {
            var position = new google.maps.LatLng(point.lat, point.lng);

            var marker = new google.maps.Marker({
                position: position,
                map: map
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

        habilitarMarker();
    }
    
    window.initMap() = initMap();
</script>

@endsection