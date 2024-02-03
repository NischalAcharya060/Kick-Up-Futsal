@extends('user.layouts.app')
@section('title', 'Payment')
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
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

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
