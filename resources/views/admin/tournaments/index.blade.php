@extends('admin.layouts.admin_dashboard')
@section('title', 'Tournaments')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Tournaments</h4>

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

        <div class="text-right mb-3">
            <a href="{{ route('admin.tournaments.create') }}" class="btn btn-primary">
                <i class='bx bx-trophy'></i> Add Tournament
            </a>
        </div>

        @if($tournaments->isEmpty())
            <div class="alert alert-danger">
                <p>No tournament at this time.</p>
            </div>
        @else

        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility ID</th>
                            <th>Facility Name</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Map Coordinates</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($tournaments as $tournament)
                            <tr>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->id }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->facility->id }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->facility->name }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->name }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->description }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->facility->location }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->facility->map_coordinates }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->start_date }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $tournament->end_date }}</td>
                                <td>
                                    <a href="{{ route('admin.tournaments.edit', ['tournament' => $tournament->id]) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <a href="{{ route('admin.tournamentMatches.create', ['tournamentId' => $tournament->id]) }}" class="btn btn-primary" title="Add Match">
                                        <i class='bx bx-plus-circle'></i>
                                    </a>
                                    <a href="{{ route('admin.tournaments.matches', ['tournamentId' => $tournament->id]) }}" class="btn btn-info btn-sm" title="View Matches">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <form action="{{ route('admin.tournaments.destroy', ['tournament' => $tournament->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('styles')
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
