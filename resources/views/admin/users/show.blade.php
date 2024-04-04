@extends('admin.layouts.admin_dashboard')
@section('title', 'User Details')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">User Details</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">User ID:</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>

                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">User Type:</dt>
                    <dd class="col-sm-9">{{ $user->user_type }}</dd>

                    <dt class="col-sm-3">Profile Picture:</dt>
                    <dd class="col-sm-9">
                        @if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture))
                            <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="{{ $user->name }}'s Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
                        @else
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Profile Picture" class="img-fluid rounded-circle" style="max-width: 150px;">
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

        <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">
            <i class='bx bx-arrow-back'></i> Back to User List
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_user_management.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        dt {
            font-weight: bold;
            color: #555;
        }

        dd {
            margin-bottom: 10px;
        }
    </style>
@endsection
