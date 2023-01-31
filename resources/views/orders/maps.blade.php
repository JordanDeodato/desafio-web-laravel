@extends('layouts.admin')
@section('container')

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY&callback=initMap&v=weekly" defer></script>

<div id="map" style="height: 500px;"></div>


<?php

foreach ($orders as $order) {
    echo "<p class='ceps'>$order->zipcode</p>";
}
?>



<script>
    let ceps = document.querySelectorAll('.ceps');
    console.log(ceps[0])
    let points = [];

    let map;
    let markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -7.121268,
                lng: -34.880279
            },
            zoom: 8,
        });
        var position = new google.maps.LatLng(-7.121268, -34.880279);

        var marker = new google.maps.Marker({
            position: position,
            map: map
        });

        habilitarMarker();
    }

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

    window.initMap() = initMap();



    async function searchCep() {

        let response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${cep}&key=AIzaSyA1_i3iEG1p-ST_UBqF1R-2YG870NMOyWY`);

        let coords = await response.json();

        lat = Number(coords.results[0].geometry.location.lat);
        lng = Number(coords.results[0].geometry.location.lng);

        console.log(lat)
        console.log(lng)

        window.initMap = initMap;



    }
</script>

@endsection