@extends('user.layouts.app')
@section('title', 'Create Team')
@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Create Team</h2>
        </div>

        <div class="card border-0 shadow">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('user.teams.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Team Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Team</button>
                </form>
            </div>
        </div>
    </div>
@endsection
