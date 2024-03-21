@extends('admin.layouts.admin_dashboard')
@section('title', 'Calendar')

@section('content')
    <div class="container">
    <div id="calendar"></div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Booking List</h1>
                <div class="list-group">
                    @php $counter = 1 @endphp
                    @foreach($bookedDates as $booking)
                        <a  class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <h5 class="mb-1">{{ $counter++ }}. {{ $booking['facilityName'] }}</h5>
                                <span class="badge badge-primary badge-pill">{{ \Carbon\Carbon::parse($booking['bookingDate'] . ' ' . $booking['bookingTime'])->format('F j, Y h:i A') }}</span>
                            </div>
                            <p class="mb-1">Booked by: <span class="text-primary">{{ $booking['userName'] }}</span></p>
                            <p class="mb-1">Payment Method: <span class="text-warning">{{ $booking['bookingPaymentMethod'] }}</span></p>
                            <p class="mb-1">Booking Amount: <span class="text-info">{{ $booking['bookingAmount'] }}</span></p>
                            <p class="mb-1">Booking Status: <span class="text-success">{{ $booking['bookingStatus'] }}</span></p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($bookedDates),
                eventRender: function(info) {
                    if (info.event.extendedProps.status === 'booked') {
                        info.el.classList.add('badge badge-primary badge-pill');
                    }
                },
            });
            calendar.render();
        });
    </script>
@endsection

@section('styles')
    <style>
        .booked-event {
            background-color: #ff7675;
            border-color: #d63031;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
