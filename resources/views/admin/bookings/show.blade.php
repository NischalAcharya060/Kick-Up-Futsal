@extends('admin.layouts.admin_dashboard')
@section('title', 'Booking Details')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Booking Details</h4>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Booking Information</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>User ID:</strong> {{ $booking->user_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Facility ID:</strong> {{ $booking->facility_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Booking Date:</strong> {{ $booking->booking_date }}
                    </li>
                    <li class="list-group-item">
                        <strong>Booking Time:</strong> {{ $booking->booking_time }}
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
        /* Add any custom styles here */
    </style>
@endsection
