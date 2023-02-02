@extends('layouts.admin')
@section('container')

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY&callback=initMap&v=weekly" defer></script>

<div id="map" style="height: 500px;"></div>

<script>    
    
    var points = [<?php foreach($orders as $order) {echo ($order->coords) . ',';} ?>]; //Salvando as coordenadas obtidas do banco
    var markers = []; //Inserindo os marcadores
    var map;

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