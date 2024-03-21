@extends('user.layouts.app')
@section('title', 'About Us')
@section('content')
<br>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">About Us</h2>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-md-6">
                        <img src="{{ asset('img/img-1.jpg') }}" alt="pic1" class="img-fluid mb-2">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('img/img-2.jpg') }}" alt="pic2" class="img-fluid mb-2">
                    </div>
                    <div class="col-md-14">
                        <img src="{{ asset('img/img-3.jpg') }}" alt="pic3" class="img-fluid mb-2">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Your Vision</h3>
                        <p>
                            We envision a thriving badminton ecosystem with innovative technologies that enhance skills and cultivate a love for the sport.
                            Our platform inspires individuals to unleash their full potential in futsal. We revolutionize football, empowering players to excel.
                            Our platform offers comprehensive tools and support for growth within the football community. Join us and reach new heights of excellence!
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h3>Our Mission</h3>
                        <p>
                            We provide players with a seamless platform for connectivity and personalized insights. Together, we foster a collaborative community
                            that supports growth and success in futsal.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-footer />

@endsection
