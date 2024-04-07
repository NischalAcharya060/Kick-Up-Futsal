@extends('user.layouts.app')
@section('title', $facility->name)
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">{{ $facility->name }}</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->has('date'))
            <div class="alert alert-danger">
                {{ $errors->first('date') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="facility-gallery">
                    @if ($facility->image_path)
                        <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" alt="{{ $facility->name }}" class="facility-image rounded-4">
                    @else
                        <img src="{{ asset('img/img-1.jpg') }}" class="facility-image rounded-4" alt="{{ $facility->name }}">
                    @endif
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <p class="card-text">{{ $facility->description }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $facility->location }}</p>
                        <div id="map" class="facility-map"></div>
                        <p class="card-text"><strong>Price per Hour:</strong> Rs. {{ number_format($facility->price_per_hour) }}</p>
                        <p class="card-text"><strong>Facility Type:</strong> {{ $facility->facility_type }}</p>
                        <p class="card-text">
                            <strong>Opening Time:</strong> {{ \Carbon\Carbon::parse($facility->opening_time)->format('h:i A') }}
                        </p>
                        <p class="card-text">
                            <strong>Closing Time:</strong> {{ \Carbon\Carbon::parse($facility->closing_time)->format('h:i') }} PM
                        </p>
                        <p class="card-text"><strong>Contact Person:</strong> {{ $facility->contact_person }}</p>
                        <p class="card-text"><strong>Contact Email:</strong> {{ $facility->contact_email }}</p>
                        <p class="card-text"><strong>Contact Phone:</strong> {{ $facility->contact_phone }}</p>
                    </div>
                </div>
            </div>

                <!-- Date and Time Selection Form -->
                <div class="booking-form mt-5">
                    <h3>Book this Facility</h3>
                    <form action="{{ route('user.booking.confirm', ['facilityId' => $facility->id]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="date">Select Date:</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="time">Select Time:</label>
                            <input type="time" id="time" name="time" class="form-control" required>
                        </div>

                        <button type="submit" class="book-btn"><i class='bx bx-calendar'></i> Proceed to Book</button>
                    </form>
                </div>

            <div class="col-md-12 mt-4">
            <!-- Display Ratings and Reviews -->
                @if($ratingsAndReviews->isNotEmpty())
                    <div class="ratings-reviews mt-5">
                        <h3>Ratings and Reviews</h3>
                        @foreach($ratingsAndReviews as $booking)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="profile-picture">
                                            @if ($booking->user->profile_picture && Storage::exists('public/profile_pictures/' . $booking->user->profile_picture))
                                                <img src="{{ asset('storage/profile_pictures/' . $booking->user->profile_picture) }}" alt="{{ $booking->user->name }}" class="rounded-circle">
                                            @else
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Default Profile Picture" class="rounded-circle">
                                            @endif
                                        </div>
                                        <div class="review-details ms-3">
                                            <h5 class="card-title">{{ $booking->user->name }}</h5>
                                            <!-- Display Rating -->
                                            <div class="rating-stars">@ratingStars($booking->ratings)</div>
                                            <!-- Display Review -->
                                            <p class="card-text">{{ $booking->reviews }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No ratings and reviews available for this facility.</p>
                @endif
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var coordinates = [{{ $facility->map_coordinates }}];
            var map = L.map('map').setView(coordinates, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker(coordinates).addTo(map);
        });
    </script>

    <script>
        // Initialize datepicker and timepicker
        $(document).ready(function () {
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });

            $('#time').timepicker({
                showMeridian: false,
                defaultTime: 'current',
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        .custom-star {
            color: yellow;
            font-size: 20px;
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

        .facility-gallery img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .facility-map {
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 10px;
        }

        .ratings-reviews .card {
            margin-bottom: 20px;
        }

        .profile-picture img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .rating-stars {
            color: yellow;
            font-size: 20px;
        }

        .booking-form form {
            max-width: 400px;
            margin-top: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
