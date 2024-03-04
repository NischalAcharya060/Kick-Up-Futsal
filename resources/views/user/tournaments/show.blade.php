@extends('user.layouts.app')

@section('title', $tournament->name)

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow">
            <div class="card-body">
                <h2 class="mb-4">{{ $tournament->name }}</h2>

                <p><strong>Description:</strong> {{ $tournament->description }}</p>
                <p><strong>Location:</strong> {{ $tournament->location }}</p>
                <p><strong>Map Coordinates:</strong> {{ $tournament->map_coordinates }}</p>

                <div id="map" style="height: 300px; border-radius: 8px; overflow: hidden;"></div>

                <p><strong>Start Date:</strong> {{ $tournament->start_date }}</p>
                <p><strong>End Date:</strong> {{ $tournament->end_date }}</p>

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

                <form action="{{ route('user.tournaments.join', ['tournament' => $tournament->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Join Tournament</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var coordinates = [{{ $tournament->map_coordinates }}];
            var map = L.map('map').setView(coordinates, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker(coordinates).addTo(map);
        });
    </script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
@endsection
