@extends('user.layouts.app')
@section('title', 'Booking')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Explore Futsal Grounds</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($facilities as $facility)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}">
                            <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="card-img-top rounded-4 img-fluid" alt="{{ $facility->name }}">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $facility->name }}</h5>
                            <p class="card-text text-muted">Price: Rs. {{ number_format($facility->price_per_hour) }}</p>

                            <div class="mt-3">
                                <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}" class="btn btn-primary btn-block">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center">No futsal grounds available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
