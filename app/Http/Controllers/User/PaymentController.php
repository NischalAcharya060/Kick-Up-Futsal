<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Payment;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('user.booking.payment');
    }

}
