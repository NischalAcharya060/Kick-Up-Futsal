@extends('admin.layouts.admin_dashboard')
@section('title', 'Create User')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Create User</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select name="user_type" id="user_type" class="form-control">
                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="futsal_manager" {{ old('user_type') == 'futsal_manager' ? 'selected' : '' }}>Futsal Manager</option>
                    <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Create User</button>
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
