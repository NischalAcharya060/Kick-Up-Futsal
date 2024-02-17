<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class UserDashboardController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();

        return view('user.dashboard' , compact('facilities'));
    }
}
