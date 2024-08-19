
@extends('layouts.dashboard-volt')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
        height: 600px;
    }
</style>
@endsection
@section('content')
<h1>Peta dengan Pin</h1>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-7.9467993,112.6161547], 19); // Pusat peta dan zoom level

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan pin-pind, 


    var markers = [
        {lat: -7.947040, lng: 112.615812, title: 'Parkir E-Bike A1'},
        {lat: -7.947715, lng: 112.615697, title: 'Parkir E-Bike A2'},
        {lat: -7.946479, lng: 112.616153, title: 'Parkir E-Bike A3'}
        // Tambahkan pin lainnya di sini
    ];

    markers.forEach(function(marker) {
        L.marker([marker.lat, marker.lng]).addTo(map).bindPopup(marker.title);
    });
</script>
@endsection