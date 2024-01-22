@extends('admin.layouts.admin_dashboard')
@section('title', 'Edit Facility')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Edit Facility</h4>

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

        <form action="{{ route('admin.facilities.update', $facility->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $facility->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control">{{ $facility->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control" value="{{$facility->location}}">
            </div>

            <div class="form-group">
                <label for="image">Facility Image:</label>
                <input type="file" id="image" name="image" class="form-control" value="{{$facility->image}}">
            </div>

            <button type="submit" class="btn btn-success">Update Facility</button>
            <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
        </form>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection

