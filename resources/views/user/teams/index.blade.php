@extends('user.layouts.app')

@section('title', 'Teams')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Teams</h2>
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
                    @forelse ($teams as $team)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $loop->iteration }}. Team Name:</strong> {{ $team->name }}
                                    <br>
                                    <strong>Joined Members:</strong>
                                    @forelse ($team->users as $user)
                                        {{ $user->name }},
                                    @empty
                                        No members not joined yet.
                                    @endforelse
                                </div>

                                <div class="text-right">
                                    @if(!$team->users->contains(Auth::id()))
                                        <a href="{{ route('user.teams.join', ['team' => $team->id]) }}" class="btn btn-success">Join Team</a>
                                    @else
                                        <a href="{{ route('user.teams.leave', ['team' => $team->id]) }}" class="btn btn-danger">Leave Team</a>

                                        <form action="{{ route('user.teams.invite', ['team' => $team->id]) }}" method="POST" class="mt-2">
                                            @csrf
                                            <div class="form-group">
                                                <label for="users">Select Users to Invite:</label>
                                                <select name="invited_user" id="users" class="form-control" required>
                                                    <option value="" disabled selected>Select user to invite</option>
                                                    @foreach($usersToInvite as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send Invitation</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center">
                            No teams found.
                            <br>
                            <a href="{{ route('user.teams.create') }}" class="btn btn-primary mt-3">Create a Team</a>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
