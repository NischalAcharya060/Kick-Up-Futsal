@extends('admin.layouts.admin_dashboard')
@section('title', 'Create Tournament')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Create Tournament</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.tournaments.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tournament Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-sm-2 col-form-label">Location:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="location" name="location" onchange="updateMap()" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="map_coordinates" class="col-sm-2 col-form-label">Map Coordinates:</label>
                <div class="col-sm-10">
                    <input type="hidden" id="map_coordinates" name="map_coordinates" class="form-control">
                </div>
            </div>
            <div id="map" style="height: 300px;"></div>

            <div class="form-group row">
                <label for="start_date" class="col-sm-2 col-form-label">Start Date:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="end_date" class="col-sm-2 col-form-label">End Date:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Create Tournament</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([0, 0], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([0, 0], { draggable: true }).addTo(map);

            marker.on('dragend', function (event) {
                var position = marker.getLatLng();
                console.log('Coordinates:', position.lat, position.lng);
                document.getElementById('map_coordinates').value = position.lat + ',' + position.lng;
            });

            window.updateMap = function () {
                var locationInput = document.getElementById('location').value;

                if (locationInput) {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationInput)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                var newCoordinates = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                                map.setView(newCoordinates, 15);
                                marker.setLatLng(newCoordinates);
                                document.getElementById('map_coordinates').value = newCoordinates.join(',');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching coordinates:', error);
                        });
                }
            };
        });
    </script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
