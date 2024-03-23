@extends('admin.layouts.admin_dashboard')
@section('title', 'Create Tournament Match')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Tournament Match</div>

                    <div class="card-body">
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
                        <form method="POST" action="{{ route('admin.tournamentMatches.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="tournament_id">Select Tournament:</label>
                                <select name="tournament_id" class="form-control" id="tournament_id">
                                    <option value="">Select Tournament</option>
                                    @foreach($tournaments as $tournament)
                                        <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="team1_id">Select Team 1:</label>
                                <select name="team1_id" class="form-control" id="team1_id">
                                    <option value="">Select Team 1</option>
                                    @foreach($tournament->teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="team2_id">Select Team 2:</label>
                                <select name="team2_id" class="form-control" id="team2_id">
                                    <option value="">Select Team 2</option>
                                    @foreach($tournament->teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="round">Round:</label>
                                <select name="round" class="form-control" id="round">
                                    <option value="1">Round 1</option>
                                    <option value="2">Round 2</option>
                                    <option value="3">Round 3</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Match</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('.form-control').select2({
                width: '100%',
                theme: "classic"
            });
        });
    </script>
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .btn-primary {
            background-color: #3C91E6;
            border-color: #3C91E6;
            color: white;
        }

        .btn-warning,
        .btn-danger {
            color: white;
        }
    </style>
@endsection
