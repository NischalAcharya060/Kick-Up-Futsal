@extends('admin.layouts.admin_dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <h2 class="mb-4">Welcome, {{ $user->name }}!</h2>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-primary text-white rounded shadow">
                    <div class="card-body text-center">
                        <i class='bx bx-user bx-lg'></i>
                        <h5 class="card-title mt-3">Total Users</h5>
                        <p class="card-text">{{ $userCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-success text-white rounded shadow">
                    <div class="card-body text-center">
                        <i class='bx bx-calendar bx-lg'></i>
                        <h5 class="card-title mt-3">Total Bookings</h5>
                        <p class="card-text">{{ $bookingCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-info text-white rounded shadow">
                    <div class="card-body text-center">
                        <i class='bx bxs-building bx-lg'></i>
                        <h5 class="card-title mt-3">Total Facilities</h5>
                        <p class="card-text">{{ $facilityCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-warning text-white rounded shadow">
                    <div class="card-body text-center">
                        <i class='bx bx-user-circle bx-lg'></i>
                        <h5 class="card-title mt-3">Total Futsal Managers</h5>
                        <p class="card-text">{{ $futsalManagerCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .card-body i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
