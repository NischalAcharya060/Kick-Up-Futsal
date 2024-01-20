@extends('user.layouts.app')
@section('title', 'User Profile')
@section('content')
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Profile Page
        </h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-right mt-3">
            <a href="{{ route('user.facility_submissions.create') }}" class="btn btn-primary">List Your Facility</a>
        </div>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                           href="#account-general">Account Details</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="#account-additional">Additional Details</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                           href="#account-change-password">Security</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <form action="{{ route('admin.profile.update.details') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body media align-items-center">
                                    @if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture))
                                        <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt class="d-block ui-w-80">
                                    @else
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt class="d-block ui-w-80">
                                    @endif

                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" class="account-settings-fileinput" name="profile_picture">
                                        </label> &nbsp;
                                        <div class="text-light small mt-1">Allowed JPG, GIF, or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control mb-1" name="name" value="{{ $user->name }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value="{{ $user->email }}">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    <button type="button" class="btn btn-default" onclick="goBack()">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="account-additional">
                            <form action="{{ route('profile.update.additionaldetails') }}" method="post">
                                @csrf
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" id="dob" name="dob" value="{{ $user->dob }}">
                                        @error('dob')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender:</label>
                                        <select id="gender" name="gender">
                                            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number:</label>
                                        <input type="tel" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
                                        @error('contact_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <textarea id="address" name="address">{{ $user->address }}</textarea>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="preferred_position">Preferred Futsal Position:</label>
                                        <input type="text" id="preferred_position" name="preferred_position" value="{{ $user->preferred_position }}">
                                        @error('preferred_position')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="experience_level">Futsal Experience Level:</label>
                                        <select id="experience_level" name="experience_level">
                                            <option value="beginner" {{ $user->experience_level === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="intermediate" {{ $user->experience_level === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="advanced" {{ $user->experience_level === 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                        @error('experience_level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                    <button type="button" class="btn btn-default" onclick="goBack()">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="account-change-password">
                            <form action="{{ route('admin.profile.update.password') }}" method="post">
                                @csrf
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="new_password">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm new password</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                        <button type="button" class="btn btn-default" onclick="goBack()">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
