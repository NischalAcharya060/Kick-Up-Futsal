@extends('user.layouts.app')
@section('title', $facility->name)
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">{{ $facility->name }}</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow">
                    @if($facility->image_path)
                        <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="card-img-top rounded-4" alt="{{ $facility->name }}">
                    @endif
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <p class="card-text">{{ $facility->description }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $facility->location }}</p>
                        <p class="card-text"><strong>Map Coordinates:</strong> {{ $facility->map_coordinates }}</p>
                        <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>
                        <p class="card-text"><strong>Price per Hour:</strong> Rs. {{ number_format($facility->price_per_hour) }}</p>
                        <p class="card-text"><strong>Facility Type:</strong> {{ $facility->facility_type }}</p>
                        <p class="card-text"><strong>Opening Time:</strong> {{ $facility->opening_time }}</p>
                        <p class="card-text"><strong>Closing Time:</strong> {{ $facility->closing_time }}</p>
                        <p class="card-text"><strong>Contact Person:</strong> {{ $facility->contact_person }}</p>
                        <p class="card-text"><strong>Contact Email:</strong> {{ $facility->contact_email }}</p>
                        <p class="card-text"><strong>Contact Phone:</strong> {{ $facility->contact_phone }}</p>

                        <div class="mt-3">
                            <form action="{{ route('user.booking.book', ['facilityId' => $facility->id]) }}" method="post">
                                @csrf
                                <label for="bookingTime">Select Time Slot:</label>
                                <select name="bookingTime" id="bookingTime" class="form-control">
                                    @foreach($availableTimeSlots as $timeSlot)
                                        <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-block mt-3">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var coordinates = [{{ $facility->map_coordinates }}];
            var map = L.map('map').setView(coordinates, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker(coordinates).addTo(map);
        });
    </script>

@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
