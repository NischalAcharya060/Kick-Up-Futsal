@extends('admin.layouts.admin_dashboard')
@section('title', 'Facilities')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Facilities</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="text-right mb-3">
            <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
                <i class='bx bx-building'></i> Add Facility
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">S.N</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility Image</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Map Coordinates</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Price per Hour</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Facility Type</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Opening Time</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Closing Time</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Contact Person</th>
                    <th>Contact Email</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Contact Phone</th>
                    <th style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Added By</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($facilities as $facility)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($facility->image_path)
                                <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" alt="Facility Image" class="img-fluid">
                            @else
                                No Image Available
                            @endif
                        </td>
                        <td>{{ $facility->id }}</td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $facility->name }}</td>
                        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $facility->description }}</td>
                        <td>{{ $facility->location }}</td>
                        <td>{{ $facility->map_coordinates }}</td>
                        <td>Rs. {{ $facility->price_per_hour }}</td>
                        <td>{{ $facility->facility_type }}</td>
                        <td>{{ $facility->opening_time }}</td>
                        <td>{{ $facility->closing_time }}</td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $facility->contact_person }}</td>
                        <td>{{ $facility->contact_email }}</td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $facility->contact_phone }}</td>
                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $facility->addedBy ? $facility->addedBy->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.facilities.show', $facility) }}" class="btn btn-info btn-sm" title="View">
                                <i class='bx bx-show'></i>
                            </a>
                            <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this facility?')">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $facilities->links('vendor.pagination.bootstrap-4') }}
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
