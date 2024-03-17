@extends('admin.layouts.admin_dashboard')
@section('title', 'Create Tournament')
@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">Create Tournament</h4>

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

        <form action="{{ route('admin.tournaments.store') }}" method="POST">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tournament Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="facility_id" class="col-sm-2 col-form-label">Select Facility:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="facility_id" name="facility_id">
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-sm-2 col-form-label">Start Date:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="end_date" class="col-sm-2 col-form-label">End Date:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Create Tournament</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#facility_id').select2({
                placeholder: 'Select Facility',
                width: '100%',
                theme: "classic"
            });
        });
    </script>
@endsection

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
