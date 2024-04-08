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

            @if($bookings->isEmpty())
                <div class="alert alert-danger">
                    No booking at this time.
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">S.N</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">User Id</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">User Name</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility ID</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility Name</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Booking Date</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Booking Time</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Booking Hours</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Amount</th>
                        <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Payment Method</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user_id }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $booking->user->name }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $booking->facility_id }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $booking->facility->name }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i a') }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"> {{ $booking->hours }} hour</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Rs. {{ $booking->amount }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $booking->payment_method }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                @if($booking->status == 'Payment Completed')
                                    <span class="badge bg-success text-white">{{ $booking->status }}</span>
                                @elseif($booking->status == 'Payment Pending')
                                    <span class="badge bg-info text-white">{{ $booking->status }}</span>
                                @elseif($booking->status == 'Booking Cancelled')
                                    <span class="badge bg-danger text-white">{{ $booking->status }}</span>
                                @else
                                    <span class="badge bg-secondary text-white">{{ $booking->status }}</span>
                                @endif
                            </td>
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
        @endif
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
