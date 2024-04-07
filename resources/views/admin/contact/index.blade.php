@extends('admin.layouts.admin_dashboard')

@section('title', 'Contact Us Form Logs')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Form Submissions</h3>
            </div>
            @if($submissions->isEmpty())
                <div class="alert alert-danger">
                    <p>No contact submission at this time.</p>
                </div>
            @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($submissions as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $submission->user_id }}</td>
                                <td>{{ $submission->name }}</td>
                                <td>{{ $submission->email }}</td>
                                <td>{{ $submission->subject }}</td>
                                <td>{{ $submission->message }}</td>
                                <td>{{ \Carbon\Carbon::parse($submission->created_at)->format('F j, Y / h:i A') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $submissions->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .table {
            font-size: 14px;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            border-color: #dee2e6;
            font-weight: bold;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
@endsection
