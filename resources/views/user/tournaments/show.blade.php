@extends('user.layouts.app')

@section('title', $tournament->name)

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow">
            <div class="card-body">
                <h2 class="mb-4">{{ $tournament->name }}</h2>

                <div class="tournament-details">
                    <div class="details-row">
                        <p><strong>Description:</strong> {{ $tournament->description }}</p>
                        <p><strong>Ground:</strong> {{ $tournament->facility->name }}</p>
                        <p><strong>Location:</strong> {{ $tournament->facility->location }}</p>
                        <p><strong>Map Coordinates:</strong> {{ $tournament->facility->map_coordinates }}</p>
                    </div>

                    <div class="details-row">
                        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($tournament->start_date)->format('F j, Y') }}</p>
                        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($tournament->end_date)->format('F j, Y') }}</p>
                    </div>
                </div>

                <div id="map" class="mt-4" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>

                <h3 class="mt-4">Joined Teams:</h3>
                @if($tournament->teams->isNotEmpty())
                    <ul class="list-group mb-4">
                        @foreach($tournament->teams as $team)
                            <li class="list-group-item">{{ $team->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No teams have joined this tournament yet.</p>
                @endif

                <div class="d-flex justify-content-between align-items-center">
                    <form action="{{ route('user.tournaments.join', ['tournament' => $tournament->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class='bx bx-group'></i> Join Tournament
                        </button>
                    </form>

                    <a href="{{ route('user.tournaments.index') }}" class="btn btn-outline-secondary">
                        <i class='bx bx-arrow-back'></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var coordinates = [{{ $tournament->facility->map_coordinates }}];
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
