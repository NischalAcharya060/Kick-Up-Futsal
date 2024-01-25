@extends('admin.layouts.admin_dashboard')
@section('title', 'Create Facility')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Create Facility</h4>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.facilities.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-sm-2 col-form-label">Location:</label>
                <div class="col-sm-10">
                    <input type="text" id="location" name="location" class="form-control" onchange="updateMap()">
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
                <label for="price_per_hour" class="col-sm-2 col-form-label">Price per Hour:</label>
                <div class="col-sm-10">
                    <input type="text" id="price_per_hour" name="price_per_hour" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="facility_type" class="col-sm-2 col-form-label">Facility Type:</label>
                <div class="col-sm-10">
                    <select id="facility_type" name="facility_type" class="form-control">
                        <option value="indoor">Indoor</option>
                        <option value="outdoor">Outdoor</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="opening_time" class="col-sm-2 col-form-label">Opening Time:</label>
                <div class="col-sm-10">
                    <input type="time" id="opening_time" name="opening_time" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="closing_time" class="col-sm-2 col-form-label">Closing Time:</label>
                <div class="col-sm-10">
                    <input type="time" id="closing_time" name="closing_time" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="contact_person" class="col-sm-2 col-form-label">Contact Person:</label>
                <div class="col-sm-10">
                    <input type="text" id="contact_person" name="contact_person" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="contact_email" class="col-sm-2 col-form-label">Contact Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="contact_email" name="contact_email" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="contact_phone" class="col-sm-2 col-form-label">Contact Phone:</label>
                <div class="col-sm-10">
                    <input type="tel" id="contact_phone" name="contact_phone" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Facility Image:</label>
                <div class="col-sm-10">
                    <input type="file" id="image" name="image" class="form-control-file">
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Create Facility</button>
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
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
