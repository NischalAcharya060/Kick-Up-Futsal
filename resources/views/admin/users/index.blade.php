@extends('admin.layouts.admin_dashboard')
@section('title', 'User Management')

@section('content')
    <div class="container">
        <h4 class="font-weight-bold py-3 mb-4">User Management</h4>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm" title="View">
                                <i class='bx bx-show'></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
