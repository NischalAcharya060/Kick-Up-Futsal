<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }
}
