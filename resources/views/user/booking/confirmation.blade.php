@extends('user.layouts.app')
@section('title', 'Booking Confirmation')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Booking Confirmation</h2>

        <div class="card border-0 shadow">
            <div class="card-body">
                <p class="card-text">Thank you for choosing us! Please review the details of your booking:</p>

                <ul class="list-group">
                    <li class="list-group-item"><strong>Facility:</strong> {{ $facility->name }}</li>
                    <li class="list-group-item"><strong>Date:</strong> {{ session('booking.date') }}</li>
                    <li class="list-group-item"><strong>Time:</strong> {{ date('h:i A', strtotime(session('booking.time'))) }}</li>
                </ul>

                <div class="mt-4">
                    <p class="card-text">Once you are ready, click the button below to proceed to the payment page.</p>
                </div>

                <form action="{{ route('user.booking.payment') }}" method="get">
                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

@endsection
