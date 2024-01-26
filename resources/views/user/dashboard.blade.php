@extends('user.layouts.app')
@section('title', 'User Dashboard')
@section('content')

    <h2>Welcome to the user Dashboard</h2>
    <form action="{{ route('logout') }}" method="get">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
