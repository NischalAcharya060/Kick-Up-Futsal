@extends('admin.layouts.admin_dashboard')
@section('title', 'Facility Details')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Facility Details</h4>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($facility->image_path)
                            <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" alt="Facility Image" class="img-fluid mb-3">
                        @else
                            <img src="{{ asset('img/img-1.jpg') }}" class="img-fluid mb-3" alt="{{ $facility->name }}">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">{{ $facility->name }}</h5>
                        <p class="card-text">{{ $facility->description }}</p>

                        <hr>

                        <dl class="row">
                            <dt class="col-sm-5">Location:</dt>
                            <dd class="col-sm-7">{{ $facility->location }}</dd>

                            <dt class="col-sm-5">Price per Hour:</dt>
                            <dd class="col-sm-7">Rs. {{ $facility->price_per_hour }}</dd>

                            <dt class="col-sm-5">Facility Type:</dt>
                            <dd class="col-sm-7">{{ $facility->facility_type }}</dd>

                            <dt class="col-sm-5">Opening Time:</dt>
                            <dd class="col-sm-7">{{ $facility->opening_time }}</dd>

                            <dt class="col-sm-5">Closing Time:</dt>
                            <dd class="col-sm-7">{{ $facility->closing_time }}</dd>

                            <dt class="col-sm-5">Contact Person:</dt>
                            <dd class="col-sm-7">{{ $facility->contact_person }}</dd>

                            <dt class="col-sm-5">Contact Email:</dt>
                            <dd class="col-sm-7">{{ $facility->contact_email }}</dd>

                            <dt class="col-sm-5">Contact Phone:</dt>
                            <dd class="col-sm-7">{{ $facility->contact_phone }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="mt-4">
                    <div id="map" style="height: 400px;"></div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-warning mr-2">Edit</a>
                    <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
