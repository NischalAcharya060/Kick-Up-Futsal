@extends('admin.layouts.admin_dashboard')
@section('title', 'Facility Details')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Facility Details</h4>

        <div class="card">
            @if($facility->image_path)
                <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" alt="Facility Image" style="max-width: 100px;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $facility->name }}</h5>
                <p class="card-text">{{ $facility->description }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $facility->location }}</p>
                <p class="card-text"><strong>Map Coordinates:</strong> {{ $facility->map_coordinates }}</p>
                <p class="card-text"><strong>Price per Hour:</strong> {{ $facility->price_per_hour }}</p>
                <p class="card-text"><strong>Facility Type:</strong> {{ $facility->facility_type }}</p>
                <p class="card-text"><strong>Opening Time:</strong> {{ $facility->opening_time }}</p>
                <p class="card-text"><strong>Closing Time:</strong> {{ $facility->closing_time }}</p>
                <p class="card-text"><strong>Contact Person:</strong> {{ $facility->contact_person }}</p>
                <p class="card-text"><strong>Contact Email:</strong> {{ $facility->contact_email }}</p>
                <p class="card-text"><strong>Contact Phone:</strong> {{ $facility->contact_phone }}</p>

                <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
