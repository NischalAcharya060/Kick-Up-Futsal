@extends('user.layouts.app')

@section('title', 'My Bookings')

@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>My Bookings</h2>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
                @if ($bookings->isEmpty())
                    <div class="alert alert-info">
                        No bookings found.
                        <a href="{{ route('user.booking.index') }}" class="alert-link">Book a Futsal Now</a>
                    </div>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">S.N</th>
                            <th>Facility</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $booking->facility->name }}</strong>
                                    @if ($booking->facility->image_path)
                                        <br>
                                        <img src="{{ asset('storage/facility_images/' . basename($booking->facility->image_path)) }}" class="img-thumbnail" alt="{{ $booking->facility->name }}" style="max-width: 100px;">
                                    @endif
                                </td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>Rs. {{ $booking->amount }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $bookings->links('vendor.pagination.bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
@endsection
