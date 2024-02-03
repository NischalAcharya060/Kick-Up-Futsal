@extends('user.layouts.app')
@section('title', 'Calendar')
@section('content')
    <div id="calendar"></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($bookedDates),
                eventRender: function(info) {
                    if (info.event.extendedProps.status === 'booked') {
                        info.el.classList.add('booked-event');
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
