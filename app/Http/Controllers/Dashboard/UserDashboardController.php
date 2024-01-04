<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }
}
