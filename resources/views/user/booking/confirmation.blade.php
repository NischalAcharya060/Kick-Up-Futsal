@extends('user.layouts.app')
@section('title', 'Booking Confirmation')
@section('content')

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Booking Confirmation</h2>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
                <p class="card-text">Thank you for choosing us! Please review the details of your booking:</p>

                <ul class="list-group">
                    <div class="card border-0 shadow">
                        @if($facility->image_path)
                            <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="card-img-top rounded-4" alt="{{ $facility->name }}">
                        @endif
                    </div>
                    <li class="list-group-item"><strong>Facility:</strong> {{ $facility->name }}</li>
                    <li class="list-group-item"><strong>Date:</strong> {{ session('booking.date') }}</li>
                    <li class="list-group-item"><strong>Time:</strong> {{ date('h:i A', strtotime(session('booking.time'))) }}</li>
                    <li class="list-group-item"><strong>Price:</strong> Rs. {{ $facility->price_per_hour }}</li>
                </ul>

                <!-- Display the map -->
                <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>

                <div class="mt-4">
                    <p class="card-text">Once you are ready, click the button below to proceed to the payment page.</p>
                </div>

                <form action="{{ route('user.booking.payment') }}" method="get">
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Leaflet.js for the map -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize map with facility coordinates
            var coordinates = [{{ $facility->map_coordinates }}];
            var map = L.map('map').setView(coordinates, 15);

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Add marker for the facility location
            var marker = L.marker(coordinates).addTo(map);
        });
    </script>

@endsection

@section('styles')
    <!-- Include Leaflet.css for map styling -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
