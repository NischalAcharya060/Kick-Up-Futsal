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

                <ul class="list-group">
                    @forelse ($teams as $team)
                        <li class="list-group-item">
                            <strong>{{ $loop->iteration }}. Team Name:</strong> {{ $team->name }}
                            <br>
                            <strong>Members:</strong>
                            @forelse ($team->users as $user)
                                {{ $user->name }},
                            @empty
                                No members yet.
                            @endforelse

                            <br>

                            @if(!$team->users->contains(Auth::id()))
                                {{-- User is not a member, provide option to join --}}
                                <a href="{{ route('user.teams.join', ['team' => $team->id]) }}" class="btn btn-success">Join Team</a>
                            @else
                                {{-- User is a member, provide option to leave --}}
                                <a href="{{ route('user.teams.leave', ['team' => $team->id]) }}" class="btn btn-danger">Leave Team</a>

{{--                                --}}{{-- Invite user to the team --}}
{{--                                <form action="{{ route('user.teams.invite', ['team' => $team->id]) }}" method="POST" class="mt-2">--}}
{{--                                    @csrf--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="email">User Email:</label>--}}
{{--                                        <input type="email" class="form-control" id="email" name="email" required>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit" class="btn btn-primary">Send Invitation</button>--}}
{{--                                </form>--}}
                            @endif
                        </li>
                    @empty
                        <li class="list-group-item">No teams found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
