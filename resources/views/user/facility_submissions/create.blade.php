@extends('user.layouts.app')
@section('title', 'Submit Facility')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Submit Facility</h4>

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

        <form action="{{ route('user.facility_submissions.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control">
            </div>

            <div class="form-group">
                <label for="map_coordinates">Map Coordinates:</label>
                <div id="map" style="height: 300px;"></div>
                <input type="hidden" id="map_coordinates" name="map_coordinates" class="form-control">
            </div>

            <div class="form-group">
                <label for="price_per_hour" class="col-sm-2 col-form-label">Price per Hour:</label>
                    <input type="text" id="price_per_hour" name="price_per_hour" class="form-control">
            </div>

            <div class="form-group">
                <label for="facility_type" class="col-sm-2 col-form-label">Facility Type:</label>
                    <select id="facility_type" name="facility_type" class="form-control">
                        <option value="indoor">Indoor</option>
                        <option value="outdoor">Outdoor</option>
                    </select>
            </div>

            <div class="form-group">
                <label for="opening_time" class="col-sm-2 col-form-label">Opening Time:</label>
                    <input type="time" id="opening_time" name="opening_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="closing_time" class="col-sm-2 col-form-label">Closing Time:</label>
                    <input type="time" id="closing_time" name="closing_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="contact_person" class="col-sm-2 col-form-label">Contact Person:</label>
                    <input type="text" id="contact_person" name="contact_person" class="form-control">
            </div>

            <div class="form-group">
                <label for="contact_email" class="col-sm-2 col-form-label">Contact Email:</label>
                    <input type="email" id="contact_email" name="contact_email" class="form-control">
            </div>

            <div class="form-group">
                <label for="contact_phone" class="col-sm-2 col-form-label">Contact Phone:</label>
                    <input type="tel" id="contact_phone" name="contact_phone" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Facility Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Submit Facility</button>
            <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
        </form>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        // Initialize the map
        function initializeMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 },
                zoom: 15
            });

            // Create a marker and place it on the map
            var marker = new google.maps.Marker({
                position: { lat: 0, lng: 0 },
                map: map,
                draggable: true
            });

            // Update the hidden input with the marker position
            google.maps.event.addListener(marker, 'dragend', function () {
                var position = marker.getPosition();
                document.getElementById('map_coordinates').value = position.lat() + ',' + position.lng();
            });
        }

        // Load the map after the DOM is ready
        document.addEventListener('DOMContentLoaded', initializeMap);
    </script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection