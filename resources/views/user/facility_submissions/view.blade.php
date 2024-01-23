@extends('admin.layouts.admin_dashboard')
@section('title', 'View Submission')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">View Submission</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Map Coordinates</th>
                    <th>Image</th>
                    <th>Price per Hour</th>
                    <th>Facility Type</th>
                    <th>Opening Time</th>
                    <th>Closing Time</th>
                    <th>Contact Person</th>
                    <th>Contact Email</th>
                    <th>Contact Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $facility->name }}</td>
                    <td>{{ $facility->description }}</td>
                    <td>{{ $facility->location }}</td>
                    <td>{{ $facility->map_coordinates }}</td>
                    <td>
                        @if($facility->image_path)
                            <img src="{{ asset($facility->image_path) }}" alt="Facility Image" style="max-width: 100px;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $facility->price_per_hour }}</td>
                    <td>{{ $facility->facility_type }}</td>
                    <td>{{ $facility->opening_time }}</td>
                    <td>{{ $facility->closing_time }}</td>
                    <td>{{ $facility->contact_person }}</td>
                    <td>{{ $facility->contact_email }}</td>
                    <td>{{ $facility->contact_phone }}</td>
                    <td>
                        @if($facility->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($facility->status === 'accepted')
                            <span class="badge badge-success">Accepted</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($facility->status === 'pending')
                            <form action="{{ route('user.facility_submissions.updateStatus', ['id' => $facility->id]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button>
                                <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Example using fetch API
        fetch('{{ route('user.facility_submissions.updateStatus', ['id' => $facility->id]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                _method: 'PATCH'
                // Add other form data here
            }),
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_user_management.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
