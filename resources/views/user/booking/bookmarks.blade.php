@extends('user.layouts.app')
@section('title', 'Bookmarks')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Bookmarks</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if($bookmarkedFacilities->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Facility Name</th>
                        <th>Location</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookmarkedFacilities as $facility)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}">
                                    @if($facility->image_path)
                                        <img src="{{ asset('storage/facility_images/' . basename($facility->image_path)) }}" class="rounded-4 img-fluid" alt="{{ $facility->name }}" style="max-width: 100px;">
                                    @else
                                        No Image Available
                                    @endif
                                </a>
                            </td>
                            <td>{{ $facility->name }}</td>
                            <td>{{ $facility->location }}</td>
                            <td>Rs. {{ number_format($facility->price_per_hour) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('user.booking.show', ['facilityId' => $facility->id]) }}" class="btn btn-primary btn-sm mr-2">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <form action="{{ route('user.unbookmark', ['facilityId' => $facility->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class='bx bx-bookmark-minus'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center mt-3">
                No bookmarked facilities available.
            </div>
        @endif
    </div>

@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection
