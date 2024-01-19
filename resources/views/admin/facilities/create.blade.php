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
                <!-- You can add the location input here -->
            </div>

            <div class="form-group">
                <label for="map_coordinates">Map Coordinates:</label>
                <div id="map" style="height: 300px;"></div>
                <input type="hidden" id="map_coordinates" name="map_coordinates" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Facility Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Facility</button>
            </div>
        </form>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

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
