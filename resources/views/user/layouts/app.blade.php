<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard')</title>
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    .btn-list-facility {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: #fff;
    }

    .btn-list-facility:hover {
        background-color: #ffbb33;
        border-color: #ffbb33;
        color: #fff;
    }
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="{{ route('user.dashboard') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <span class="text">Kick Up Futsal</span>
    </a>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class='bx bx-search'></i></button>
    </form>

    <div class="navbar-nav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard') }}">
                    <i class='bx bx-home'></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class='bx bx-info-circle'></i> About
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class='bx bx-envelope'></i> Contact Us
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('user.profile') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (auth()->check() && $user = auth()->user())
                        <div class="d-flex align-items-center">
                            @if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture))
                                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle" style="width: 30px;">
                            @else
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Profile Picture" class="rounded-circle" style="width: 30px;">
                            @endif
                            <span class="ml-2">{{ $user->name }}</span>
                        </div>
                    @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item profile-link" href="{{ route('user.profile') }}">
                        <i class='bx bxs-user'></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item logout-link">
                        <i class='bx bxs-door-open'></i>
                        Logout
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.facility_submissions.create') }}" class="btn btn-list-facility">
                    <i class='bx bx-plus'></i> List Your Facility
                </a>
            </li>
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
