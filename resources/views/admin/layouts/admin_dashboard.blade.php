<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    @yield('styles')
</head>
<body>

<section id="sidebar">
    <a href="{{route('admin.dashboard')}}" class="brand">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 65px;" />
        </div>
        <span class="text">Kick Up Futsal</span>
    </a>
    <ul class="side-menu top">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="{{ route('logout') }}" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>

<section id="content">
    <nav>
        <i class='bx bx-menu' ></i>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
            </div>
        </form>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
        <div class="dropdown">
            <a href="{{ route('admin.profile') }}" class="profile" id="profileDropdown">
                <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 65px;" />
            </a>
            <div class="dropdown-content" id="profileDropdownContent">
                <a href="{{ route('admin.profile') }}">Profile</a>
                <a href="{{ route('logout') }}" >Logout</a>
            </div>
        </div>
    </nav>
</section>

<div class="content">
    @yield('content')
</div>

<script src="{{ asset('js/admin_dashboard.js') }}"></script>
</body>
</html>
