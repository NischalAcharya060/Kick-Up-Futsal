@extends('admin.layouts.admin_dashboard')
@section('title', 'Edit User')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Edit User</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select name="user_type" id="user_type" class="form-control">
                    <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="futsal_manager" {{ $user->user_type == 'futsal_manager' ? 'selected' : '' }}>Futsal Manager</option>
                    <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_user_management.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
