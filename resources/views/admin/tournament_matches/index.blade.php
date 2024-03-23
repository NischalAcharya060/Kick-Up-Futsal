@extends('admin.layouts.admin_dashboard')
@section('title', 'Tournament Matches')
@section('content')
    <div class="container">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h4 class="font-weight-bold mb-0">Tournament Matches</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <ul class="list-group">
                    @forelse ($tournamentMatches as $match)
                        <li class="list-group-item">
                            <span class="font-weight-bold">Match ID:</span> {{ $match->id }} <br>
                            <span class="font-weight-bold">Team 1:</span> {{ $match->team1->name }} <br>
                            <span class="font-weight-bold">Team 2:</span> {{ $match->team2->name }} <br>
                            <form method="POST" action="{{ route('admin.tournaments.matches.update', ['tournamentId' => $tournament->id, 'matchId' => $match->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="team1_score">Team 1 Score:</label>
                                    <input type="number" name="team1_score" class="form-control" id="team1_score" required>
                                </div>
                                <div class="form-group">
                                    <label for="team2_score">Team 2 Score:</label>
                                    <input type="number" name="team2_score" class="form-control" id="team2_score" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Scores</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item">No matches found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #3C91E6;
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #dee2e6;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }
    </style>
@endsection
