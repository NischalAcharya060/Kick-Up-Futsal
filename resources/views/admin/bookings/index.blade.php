@extends('admin.layouts.admin_dashboard')
@section('title', 'Bookings')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Bookings</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">S.N</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">User Id</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">User Name</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility ID</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility Name</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->facility_id }}</td>
                        <td>{{ $booking->facility->name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->booking_time }}</td>

                        <td>
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-info btn-sm" title="View">
                                <i class='bx bx-show'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $bookings->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .btn-primary {
            background-color: #3C91E6;
            border-color: #3C91E6;
            color: white;
        }

        .img-fluid {
            max-width: 100px;
            height: auto;
        }
    </style>
@endsection
