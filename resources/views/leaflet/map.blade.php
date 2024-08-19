@extends('layouts.dashboard-admin')


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"
        integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #map {
            z-index: 1;
            height: calc(100vh - 55px);
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-left">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Maps</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div id="map"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Legenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <img src="{{ asset('img/red.png') }}" width="30px" alt="">
                                <h5>Titik Sepeda</h5>
                                <img src="{{ asset('img/blue.png') }}" width="30px" alt="">
                                <h5>Titik Lokasi Parkir</h5>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('img/polygon.png') }}" width="50px" alt="">
                                <h5>Titik Lokasi</h5>
                                <img src="{{ asset('img/polyline.png') }}" width="70px" alt=""><br>
                                <h5 class="mt-3">Perbatasan Lokasi</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"
        integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
    <script>
        var map = L.map('map').setView([-7.946852799368003, 112.61612206847735], 18);

        // init basemap
        var basemap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '<a href="https://ebike.net" target="_blank">ebike@2024</a>',
        });

        // add basemap to map
        basemap.addTo(map);

        // scale bar
        L.control.scale({
            position: 'bottomleft',
            metric: true,
            imperial: false,
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: false,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

            if (type === 'polyline') {
                $('#geometry-polyline').empty();
                console.log(objectGeometry);
                $('#geometry-polyline').val(objectGeometry);
                $('#createpolylineModal').modal('show');

                // modal dismiss reload
                $('#createpolylineModal').on('hidden.bs.modal', function() {
                    location.reload();
                });
            } else if (type === 'polygon' || type === 'rectangle') {
                $('#geometry-polygon').empty();
                console.log(objectGeometry);
                $('#geometry-polygon').val(objectGeometry);
                $('#createpolygonModal').modal('show');

                // modal dismiss reload
                $('#createpolygonModal').on('hidden.bs.modal', function() {
                    location.reload();
                });
            } else if (type === 'marker') {
                $('#geometry-point').empty();
                console.log(objectGeometry);
                $('#geometry-point').val(objectGeometry);
                $('#createpointModal').modal('show');

                // modal dismiss reload
                $('#createpointModal').on('hidden.bs.modal', function() {
                    location.reload();
                });
            } else {
                console.log('__undefined__');
            }

            drawnItems.addLayer(layer);
        });


        // Function to send a notification

        // Ambil data titik sepeda dari route yang sesuai


        /* GeoJSON Point */
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "<h5>Point</h5>" +
                    "<p>" + feature.properties.name + "</p>" +
                    "<div class='d-flex flex-row'>" +
                    "<a href='/edit-point/" + feature.properties.id +
                    "' class='btn btn-sm btn-warning text-dark me-2'><i class='bi bi-pencil-square'></i></a>" +
                    "<form action='/delete-point" + feature.properties.id + "' method='Post'>" +
                    '{{ csrf_field() }}' +
                    "<input type='hidden' name='_method' value='DELETE'>" +
                    "<button type='submit' class='btn btn-sm btn-danger text-light' onclick='return confirm(`Are you sure you want to delete point " +
                feature.properties.name + "?`)'><i class='bi bi-trash-fill'></i></button>" +
                    "</form>" +
                    "</div>";
                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name);
                    },
                });
            }
        });
        $.getJSON("{{ route('geojson-points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });
        let geopoly;
        /* GeoJSON Polyline */
        var polyline = L.geoJson(null, {
            style: {
                color: 'red', // Mengatur warna garis menjadi merah
                // Anda bisa menambahkan properti lain untuk styling seperti weight (tebal garis), dll.
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "<h5>Polyline</h5>" +
                    "<p>" + feature.properties.name + "</p>" +
                    "<div class='d-flex flex-row'>" +
                    "<a href='/edit-polyline/" + feature.properties.id +
                    "' class='btn btn-sm btn-warning text-dark me-2'><i class='bi bi-pencil-square'></i></a>" +
                    "<form action='/delete-polyline/" + feature.properties.id + "' method='Post'>" +
                    '<?= csrf_field() ?>' +
                    "<input type='hidden' name='_method' value='DELETE'>" +
                    "<button type='submit' class='btn btn-sm btn-danger text-light' onclick='return confirm(`Are you sure you want to delete polyline " +
                feature.properties.name + "?`)'><i class='bi bi-trash-fill'></i></button>" +
                    "</form>" +
                    "</div>";
                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('geojson-polylines') }}", function(data) {
            // console.log(data);
            geopoly = data;
            polyline.addData(data);
            map.addLayer(polyline);
        });

        function isPointInPolyline(point, polyline) {
            return L.polyline(polyline).getBounds().contains(L.latLng(point));
        }

        function sendAjaxRequest() {
            $.ajax({
                url: '/lock',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Mengambil token CSRF dari meta tag
                },
                success: function(response) {
                    // console.log(response); // Menampilkan hasil dari server
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function checkGpsPoint(lat, lng) {
            if (!geopoly) {
                console.error("GeoJSON data is not loaded");
                return;
            }

            var point = [lat, lng];
            geopoly.features.forEach(function(feature) {
                var polyline = feature.geometry.coordinates.map(function(coord) {
                    return [coord[1], coord[0]]; // Convert [lng, lat] to [lat, lng]
                });

                if (isPointInPolyline(point, polyline)) {
                    sendAjaxRequest();
                }
            });
        }


        /* GeoJSON Polygon */
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var popupContent = "<h5>" + feature.properties.name + "</h5>" +
                    // "<p>" + feature.properties.name + "</p>" +
                    "<div class='d-flex flex-row'>" +
                    "<a href='/edit-polygon/" + feature.properties.id +
                    "' class='btn btn-sm btn-warning text-dark me-2'><i class='bi bi-pencil-square'></i></a>" +
                    "<form action='/delete-polygon/" + feature.properties.id + "' method='Post'>" +
                    '<?= csrf_field() ?>' +
                    "<input type='hidden' name='_method' value='DELETE'>" +
                    "<button type='submit' class='btn btn-sm btn-danger text-light' onclick='return confirm(`Are you sure you want to delete polygon " +
                feature.properties.name + "?`)'><i class='bi bi-trash-fill'></i></button>" +
                    "</form>" +
                    "</div>";
                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('geojson-polygons') }}", function(data) {
            // console.log(data);
            geoData = data;
            // After retrieving the polygon data, retrieve the bike data
            getBikeData();
            polygon.addData(data);
            map.addLayer(polygon);
        });

        // layer control
        var layers = {
            "Point": point,
            "Polyline": polyline,
            "Polygon": polygon,
        };
        var marker; // Variabel global untuk menyimpan marker

        setInterval(getBikeData, 5000);

        function getBikeData() {
            $.getJSON("{{ route('sepeda') }}", function(data) {
                // Jika marker sudah ada, hapus marker sebelumnya
                if (marker) {
                    map.removeLayer(marker);
                }

                // Buat marker baru dengan ikon merah
                marker = L.marker([data.latitude, data.longitude], {
                    icon: L.icon({
                        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                }).addTo(map);

                // Buat konten popup
                var popupContent = "<h5>Titik Sepeda</h5>";

                // Tambahkan event ke marker
                marker.on({
                    click: function(e) {
                        marker.bindPopup(popupContent).openPopup();
                    },
                    mouseover: function(e) {
                        marker.bindTooltip('Titik Sepeda').openTooltip();
                    },
                });
            });



            $.getJSON("{{ route('sepeda') }}", function(bikeData) {
                const bikeLat = bikeData.latitude;
                const bikeLng = bikeData.longitude;
                checkBikeLocation(bikeLat, bikeLng);
                checkGpsPoint(bikeLat, bikeLng);
            });
        }

        let geoData;
        const buildingNumbers = {
            "AA": 1,
            "AE": 2,
            "AI": 3,
            "AM": 4,
            "AR": 5,
            "AW": 6,
            "GRAHA POLINEMA": 7,
            "AB": 8,
            "AF": 9,
            "AJ": 10,
            "AO": 11,
            "AS": 12,
            "AX": 13,
            "TI & TS": 14,
            "AC": 15,
            "AG": 16,
            "AK": 17,
            "AU": 18,
            "Teknik Mesin": 19,
            "AD": 20,
            "AH": 21,
            "AL": 22,
            "AQ": 23,
            "AV": 24
        };

        function checkBikeLocation(lat, lng) {
            if (!geoData) {
                console.error("GeoJSON data is not loaded");
                return;
            }

            // Loop through all the features in the geoData
            geoData.features.forEach(feature => {
                const polygon = feature.geometry.coordinates[0].map(coord => [coord[1], coord[
                    0]]); // Convert [lng, lat] to [lat, lng]

                if (isPointInPolygon([lat, lng], polygon)) {
                    // Send a notification
                    sendNotification(feature.properties.name);
                }
            });
        }

        // Helper function to check if a point is in a polygon using Leaflet.js
        function isPointInPolygon(point, polygon) {
            return L.polygon(polygon).getBounds().contains(L.latLng(point));
        }



        function sendNotification(locationName) {
            console.log(locationName);

            // Get the corresponding number for the building
            const buildingNumber = buildingNumbers[locationName];

            // Send an AJAX request to update the database
            if (buildingNumber) {
                $.ajax({
                    url: "{{ route('update-database') }}", // Update with your actual route
                    method: "POST",
                    data: JSON.stringify({
                        id: 1,
                        nomor: buildingNumber
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    contentType: "application/json",
                    success: function(response) {
                        console.log("Database updated:", response);
                    },
                    error: function(error) {
                        console.error("Error updating database:", error);
                    }
                });
            } else {
                console.error("Building number not found for:", locationName);
            }
        }
    </script>
@endpush
