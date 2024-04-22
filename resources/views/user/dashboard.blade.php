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
                        <h2 class="heading">Choose your Facility and start playing futsal</h2>
                        <a href="{{ route('user.booking.index') }}" class="btn-custom"> <i class='bx bxs-calendar'></i> Book Now <i class='bx bxs-right-arrow-alt'></i></a>
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
                        <a href="{{ route('register') }}" class="btn-custom"><i class='bx bx-user-plus'></i> Register Now <i class='bx bxs-right-arrow-alt'></i></a>
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
                        <a href="{{ route('user.booking.index') }}" class="btn-custom"><i class='bx bxs-building'></i> Select Facility <i class='bx bxs-right-arrow-alt'></i></a>
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
                        <a href="{{ route('user.booking.index') }}" class="btn-custom"><i class='bx bxs-calendar'></i> Book Now <i class='bx bxs-right-arrow-alt'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Facilities container -->
    <div class="container mt-5">
        <h1 class="text-center mb-5">Featured Facilities</h1>
        <div class="row">
            @php $counter = 0 @endphp
            @forelse($facilities as $facility)
                @if($counter < 3)
                    <div class="col-md-4 mb-4">
                        <div class="card border-5 shadow-sm">
                            <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}">
                                <div class="position-relative">
                                    @if($facility->image_path)
                                        <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="card-img-top rounded-4 img-fluid" alt="{{ $facility->name }}">
                                    @else
                                        <div class=" text-light text-center ">
                                            <img src="{{ asset('img/img-1.jpg') }}" class="card-img-top rounded-4 img-fluid" alt="{{ $facility->name }}">
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ $facility->name }}</h5>
                                <p>Location: {{ $facility->location }}</p>
                                <p class="card-text text-muted"> Rs. {{ number_format($facility->price_per_hour) }}</p>

                                <div class="mt-3 d-flex align-items-center justify-content-between">
                                    <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}" class="book-button">
                                        <i class='bx bx-calendar'></i> Book Now
                                    </a>

                                    @auth
                                        <form action="{{ route('user.facility.bookmark', ['facility' => $facility->id]) }}" method="post" class="ml-2">
                                            @csrf
                                            <button type="submit" class="btn btn-bookmark" style="transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;" onmouseover="this.style.color='#FF5733'" onmouseout="this.style.color=''; this.style.transform='';">
                                                <i class='bx bx-bookmark'></i>
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $counter++ @endphp
                @else
                    @break
                @endif
            @empty
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        No futsal grounds available at the moment.
                    </div>
                </div>
            @endforelse
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="{{ route('user.booking.index') }}" class="btn-custom">View all Featured <i class='bx bxs-right-arrow-alt'></i></a>
            </div>
        </div>
    </div>


     <x-footer />
@endsection

@section('styles')
    <style>
        .heading{
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: inline-block;
            position: relative;
            text-decoration: underline;
            text-decoration-color: transparent;
            text-decoration-style: wavy;
            padding-bottom: 8px;
            border-radius: 25%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
