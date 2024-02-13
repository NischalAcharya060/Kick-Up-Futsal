@extends('user.layouts.app')
@section('title', 'Home')
@section('content')
    <!-- Hero Section -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div style="position: relative; text-align: center;">
                    <img src="{{ asset('img/Futsal.jpg') }}" alt="Futsal Image" class="img-fluid mb-4" style="width: 100%; border-radius: 10px;">

                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff;">
                        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Choose your Facility and start playing futsal</h2>
                        <a href="{{ route('user.booking.index') }}" class="btn btn-list-facility"> <i class='bx bxs-calendar'></i> Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How it works container -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">How It Works</h1>
        <div class="row">
            <!-- Join Us card -->
            <div class="col-md-4 mb-4">
                <div class="main-card h-100 text-center">
                    <div class="How-it-card">
                        <i class='bx bx-user-plus bx-4x mb-3 icon' style="font-size: 4rem;"></i>
                        <h5 class="card-title">Join Us</h5>
                        <p class="card-text">Quick and Easy Registration: Get started on our software platform with a simple account creation process.</p>
                        <a href="{{ route('register') }}" class="btn-custom">Register Now <i class='bx bxs-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>

            <!-- Select Facility card -->
            <div class="col-md-4 mb-4">
                <div class="main-card h-100 text-center">
                    <div class="How-it-card">
                        <i class='bx bx-map bx-4x mb-3 icon' style="font-size: 4rem;"></i>
                        <h5 class="card-title">Select Facility</h5>
                        <p class="card-text">Explore our top-notch facilities and choose the one that suits your preferences for the ultimate futsal experience.</p>
                        <a href="{{ route('user.booking.index') }}" class="btn-custom">Select Facility <i class='bx bxs-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>

            <!-- Booking Process card -->
            <div class="col-md-4 mb-4">
                <div class="main-card h-100 text-center">
                    <div class="How-it-card">
                        <i class='bx bx-calendar bx-4x mb-3 icon' style="font-size: 4rem;"></i>
                        <h5 class="card-title">Booking Process</h5>
                        <p class="card-text">Easily book, pay, and enjoy a seamless experience on our user-friendly platform. Let's Booking</p>
                        <a href="{{ route('user.booking.index') }}" class="btn-custom">Book Now <i class='bx bxs-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Facilities container -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">Featured Facilities</h1>
        <div class="row">
{{--            @foreach ($featuredFacilities as $facility)--}}
{{--                <div class="col-md-4 mb-4">--}}
{{--                    <div class="card h-100 text-center">--}}
{{--                        <div class="How-it-card">--}}
{{--                            <img src="{{ asset($facility->image_path) }}" alt="{{ $facility->name }}" class="img-fluid mb-3" style="border-radius: 10px;">--}}
{{--                            <h5 class="card-title">{{ $facility->name }}</h5>--}}
{{--                            <p class="card-text">{{ $facility->description }}</p>--}}
{{--                            <a href="{{ route('user.facility.show', $facility->id) }}" class="btn btn-primary">Learn More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
        </div>
    </div>



@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
