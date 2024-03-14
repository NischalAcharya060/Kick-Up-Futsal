@extends('admin.layouts.admin_dashboard')
@section('title', 'Edit Tournament')
@section('content')
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Edit Tournament</h2>
        </div>

        <div class="card border-0 shadow">
            <div class="card-body">
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

                    <form action="{{ route('admin.tournaments.update', ['tournament' => $tournament->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tournament Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tournament->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $tournament->description) }}</textarea>
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

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($tournament->start_date))) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($tournament->end_date))) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Tournament</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection

