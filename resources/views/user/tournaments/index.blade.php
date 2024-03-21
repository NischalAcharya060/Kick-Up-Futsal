@extends('user.layouts.app')

@section('title', 'Tournaments')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Tournaments</h2>
        </div>

        <div class="card border-0 shadow">
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

                <ul class="list-group">
                    @forelse ($tournaments as $tournament)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>{{ $tournament->name }}</h5>
                                    <p>{{ $tournament->description }}</p>
                                    <p><strong>Ground:</strong> {{ $tournament->facility->name }}</p>
                                    <p><strong>Location:</strong> {{ $tournament->facility->location }}</p>
                                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($tournament->start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($tournament->end_date)->format('F j, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    @if($tournament->teams->count() < 5)
                                        {{-- Allow team to join if there is room --}}
                                        <form action="{{ route('user.tournaments.join', ['tournament' => $tournament->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success"><i class='bx bx-group'></i> Join Tournament</button>
                                        </form>
                                        <a href="{{ route('user.tournaments.show', ['tournament' => $tournament->id]) }}" class="btn btn-primary ml-2"><i class='bx bx-show'></i> Preview</a>
                                    @else
                                        {{-- Display a message indicating that the tournament is full --}}
                                        <span class="text-danger">Tournament is Full</span>
                                        <a href="{{ route('user.tournaments.show', ['tournament' => $tournament->id]) }}" class="btn btn-info ml-2"><i class='bx bx-show'></i> Preview</a>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3">
                                <strong>Joined Teams:</strong>
                                @forelse ($tournament->teams as $team)
                                    <span class="badge badge-secondary">{{ $team->name }}</span>
                                @empty
                                    <span class="badge badge-secondary">No members yet</span>
                                @endforelse
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">No tournaments found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
