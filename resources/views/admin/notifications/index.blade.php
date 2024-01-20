@extends('admin.layouts.admin_dashboard')
@section('title', 'Notification')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Notification</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($notifications as $notification)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>
                            @if($notification->is_read)
                                <span class="badge badge-success">Read</span>
                            @else
                                <span class="badge badge-warning">Unread</span>
                            @endif
                        </td>

                        <td>
                            @if($notification->user)
                                {{ $notification->user->name }}
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                            @unless($notification->is_read)
                                <button class="btn btn-primary" onclick="markAsRead('{{ route('admin.notifications.markAsRead', $notification->id) }}')">Mark as Read</button>
                            @endunless
                            <a href="{{ route('admin.notifications.viewSubmission', $notification->id) }}" class="btn btn-info">View Submission</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        <script>
            function markAsRead(url) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({}),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        </script>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_user_management.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
