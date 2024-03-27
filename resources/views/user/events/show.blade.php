@extends('user.layouts.app')

@section('title', 'Events')

@section('content')
    <div class="container">
        <h2 class="mt-5 mb-4">Upcoming Tournaments</h2>
        <div class="row">
            @forelse($upcomingTournaments as $tournament)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $tournament->name }}</h5>
                            <p class="card-text">
                                <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($tournament->start_date)->format('F j, Y') }} -
                                {{ \Carbon\Carbon::parse($tournament->end_date)->format('F j, Y') }}
                            </p>
                            <a href="#" class="btn btn-list-facility">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info" role="alert">
                        No upcoming tournaments.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            background-color: #f8f9fa; /* Light gray background */
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #343a40; /* Dark text color */
            font-size: 1.2rem;
        }

        .card-text {
            color: #6c757d; /* Medium gray text color */
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #007bff; /* Primary blue button color */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3;
        }
    </style>
@endsection
