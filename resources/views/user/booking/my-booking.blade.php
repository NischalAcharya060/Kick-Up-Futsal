@extends('user.layouts.app')
@section('title', 'My Bookings')
@section('content')

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>My Bookings</h2>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
                <ul class="list-group">
                    @forelse ($bookings as $booking)
                        <li class="list-group-item">
                            <strong>Facility:</strong> {{ $booking->facility->name }}
                            <br>
                            <strong>Date:</strong> {{ $booking->date }}
                            <br>
                            <strong>Time:</strong> {{ $booking->time }}
                        </li>
                    @empty
                        <li class="list-group-item">
                            No bookings found.
                            <a href="{{ route('user.booking.index') }}" style="color: red; text-decoration: none;">Book a Futsal Now</a>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endsection
