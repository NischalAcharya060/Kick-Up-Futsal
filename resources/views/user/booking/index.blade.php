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
        @if(count($facilities) > 0)
            <div class="row">
                @foreach($facilities as $facility)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm">
                            <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}">
                                <img src="{{ asset($facility->image_path) }}" class="card-img-top rounded-4" alt="{{ $facility->name }}">
                            </a>

                            <div class="card-body">
                                <h3 class="card-title mb-3">{{ $facility->name }}</h3>
                                <p class="card-text"> Rs. {{ number_format($facility->price_per_hour) }}</p>

                                <div class="mt-3">
                                    <a href="{{ route('user.booking.book', ['facilityId' => $facility->id]) }}" class="btn btn-primary btn-block">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">No futsal grounds available at the moment.</p>
        @endif
    </div>

@endsection
