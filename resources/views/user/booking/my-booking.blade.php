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
                        <a href="{{ route('user.booking.index') }}" class="alert-link">Book a Facility Now</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Facility</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Rating</th>
                                <th>Review</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $booking->facility->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ $booking->booking_time }}</td>
                                    <td>Rs. {{ $booking->amount }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>@ratingStars($booking->ratings)</td>
                                    <td>{{ $booking->reviews }}</td>
                                    <td>
                                        <!-- Review Form -->
                                        @if (!$booking->hasReviews())
                                            <form action="{{ route('user.bookings.storeReview', ['booking' => $booking->id]) }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="rating">Rating (1-5):</label>
                                                    <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="review">Review:</label>
                                                    <textarea name="review" id="review" class="form-control" rows="3"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $bookings->links('vendor.pagination.bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .custom-star {
            color: yellow;
            font-size: 20px;
        }

        .card-body {
            overflow-x: auto;
        }

        .table td, .table th {
            white-space: nowrap;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
