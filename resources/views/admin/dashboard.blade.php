@extends('admin.layouts.admin_dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Welcome, {{ $user->name }}!</h2>

        @if(session('success'))
            <div class="alert alert-success mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="alert alert-success mt-4" role="alert">
            All systems are running smoothly! @if($unreadNotificationCount > 0)
                You have <a style="text-decoration: none;" href="{{ route('admin.notifications.index') }}" class="alert-link">{{ $unreadNotificationCount }} unread notification(s)</a>.
            @else
                No unread notifications.
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.users.index') }}" class="card-link">
                    <div class="card bg-primary text-white rounded shadow">
                        <div class="card-body text-center">
                            <i class='bx bx-user bx-lg'></i>
                            <h5 class="card-title mt-3">Total Users</h5>
                            <p class="card-text">{{ $userCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.bookings.index') }}" class="card-link">
                    <div class="card bg-success text-white rounded shadow">
                        <div class="card-body text-center">
                            <i class='bx bx-calendar bx-lg'></i>
                            <h5 class="card-title mt-3">Total Bookings</h5>
                            <p class="card-text">{{ $bookingCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.facilities.index') }}" class="card-link">
                    <div class="card bg-info text-white rounded shadow">
                        <div class="card-body text-center">
                            <i class='bx bxs-building bx-lg'></i>
                            <h5 class="card-title mt-3">Total Facilities</h5>
                            <p class="card-text">{{ $facilityCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.tournaments.index') }}" class="card-link">
                    <div class="card bg-warning text-white rounded shadow">
                        <div class="card-body text-center">
                            <i class='bx bx-trophy'></i>
                            <h5 class="card-title mt-3">Total Tournament</h5>
                            <p class="card-text">{{ $tournamentCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="userChart"></canvas>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('admin.calendar') }}" style="text-decoration: none; color: black;">
                <div id="calendar"></div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('userChart').getContext('2d');
            var userCounts = {!! json_encode($userCounts) !!};
            var userTypes = Object.keys(userCounts);

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: userTypes,
                    datasets: [{
                        label: 'Types of Users',
                        backgroundColor: ['blue', 'green', 'orange'],
                        data: Object.values(userCounts)
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        title: { display: true, text: 'User Distribution by Type' }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($bookedDates),
                eventRender: function(info) {
                    if (info.event.extendedProps.status === 'booked') {
                        info.el.classList.add('badge', 'badge-primary', 'badge-pill');
                    }
                },
            });
            calendar.render();
        });
    </script>
@endsection

@section('styles')
    <style>
        .card {
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .card-body i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
