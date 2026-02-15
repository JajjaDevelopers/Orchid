@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title')
    {{ $page_title }}
@endsection
<!--main content section-->
@section('content')
@include('backend.layouts.dashboard.common_nav')
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">
                    <h2>Add New User</h2>
                </div>
                <div class="card-body">

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf

                        <!-- First Name -->
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <!-- Biography -->
                        <div class="form-group">
                            <label for="biography">Biography</label>
                            <textarea class="form-control" id="biography" name="biography">{{ old('biography') }}</textarea>
                        </div>

                        <!-- Skills (JSON Input) -->
                        <div class="form-group">
                            <label for="skills">Skills (comma-separated)</label>
                            <input type="text" class="form-control" id="skills" placeholder="e.g communication, analytical thinker" name="skills" value="{{ old('skills') }}">
                            <small class="form-text text-muted">Enter skills separated by commas.</small>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" value="12345678" class="form-control" id="password" name="password" required>
                            <small class="form-text text-muted">Default password is 1 to 8.</small>
                        </div>

                        <!-- Is Admin (Checkbox) -->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1">
                            <label class="form-check-label" for="is_admin">Is Admin</label>
                        </div>

                        <!-- Submit Button -->
                        <a href="{{ route('admin.user.view') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    <!--scripts section-->
    @section('scripts')
        @include('backend.components.common')
    @endsection
