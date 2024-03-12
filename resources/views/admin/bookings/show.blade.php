@extends('admin.layouts.admin_dashboard')

@section('title', 'Booking Details')

@section('content')
    <div class="container mt-4">
        <h4 class="font-weight-bold mb-4">Booking Details</h4>

        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Booking Information</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>User ID:</strong> {{ $booking->user_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>User Name:</strong> {{ $booking->user->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Facility ID:</strong> {{ $booking->facility_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Facility Name:</strong> {{ $booking->facility->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Booking Date:</strong> {{ $booking->booking_date }}
                    </li>
                    <li class="list-group-item">
                        <strong>Booking Time:</strong> {{ $booking->booking_time }}
                    </li>
                    <li class="list-group-item">
                        <strong>Amount:</strong> Rs. {{ $booking->amount }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">Back to Bookings</a>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .card {
            border-radius: 15px;
        }

        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 0;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2185d0;
            border-color: #2185d0;
        }
    </style>
@endsection
