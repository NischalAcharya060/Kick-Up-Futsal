@extends('user.layouts.app')
@section('title', 'Payment Success')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Payment Successful</h2>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
                <p class="card-text">Thank you for your payment! Your booking has been confirmed.</p>
                <a href="{{ route('user.booking.index') }}" class="btn-custom">Back <i class='bx bxs-right-arrow-alt'></i></a>

            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
