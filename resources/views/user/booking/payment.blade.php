@extends('user.layouts.app')
@section('title', 'Payment')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Payment</h2>

        <form action="{{ route('user.booking.processPayment') }}" method="post">
            @csrf

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="khalti" value="khalti" checked>
                <label class="form-check-label" for="khalti">Pay with Khalti</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">
                <label class="form-check-label" for="cash_on_delivery">Cash on Delivery</label>
            </div>

            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>

@endsection
