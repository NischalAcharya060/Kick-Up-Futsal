@extends('user.layouts.app')
@section('title', 'Booking')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Explore Futsal Grounds</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <form action="{{ route('user.booking.search') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name or location" name="search">
                <div class="input-group-append">
                    <label class="input-group-text" for="sort_by">Sort by:</label>
                    <select name="sort_by" id="sort_by" class="custom-select">
                        <option value="price_lowest" {{ $sortBy === 'price_lowest' ? 'selected' : '' }}>Lowest Price</option>
                        <option value="price_highest" {{ $sortBy === 'price_highest' ? 'selected' : '' }}>Highest Price</option>
                    </select>

                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </div>
        </form>

        <div class="row">
            @forelse($facilities as $facility)
                <div class="col-md-4 mb-4">
                    <div class="card border-5 shadow-sm">
                        <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}">
                            <div class="position-relative">
                                @if($facility->image_path)
                                    <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="card-img-top rounded-4 img-fluid" alt="{{ $facility->name }}">
                                @else
                                    <div class="bg-secondary text-light text-center p-4">
                                        No Image Available
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $facility->name }}</h5>
                            <p>Location: {{ $facility->location }}</p>
                            <p class="card-text text-muted"> Rs. {{ number_format($facility->price_per_hour) }}</p>

                            <div class="mt-3 d-flex align-items-center justify-content-between">
                                <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}" class="book-btn">
                                    <i class='bx bx-calendar'></i> Book Now
                                </a>

                                @auth
                                    <form action="{{ route('user.facility.bookmark', ['facility' => $facility->id]) }}" method="post" class="ml-2">
                                        @csrf
                                        <button type="submit" class="btn btn-bookmark" style="transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;" onmouseover="this.style.color='#FF5733'" onmouseout="this.style.color=''; this.style.transform='';">
                                            <i class='bx bx-bookmark'></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        No futsal grounds available at the moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <x-footer />
@endsection

@section('styles')
    <style>
        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .book-btn {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .book-btn:hover {
            background-color: #1593e7;
            color: #FF5733;
            text-decoration: none;
            transform: scale(1.05);
        }

        .search-btn {
            background-color: #ffffff;
            border: 1px solid black;
            color: black;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s, box-shadow 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .search-btn:hover {
            background-color: #FF8C00;
            border-color: #FF8C00;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css' rel='stylesheet'>
@endsection
