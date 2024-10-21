@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{route('register')}}">
                @csrf
                <div class="form-group">
                    <label for="first_name">Name</label>
                    <input id="first_name"
                        type="text"
                        class="form-control @error('name')
                            is-invalid
                        @enderror"
                        name="name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"
                        type="email"
                        class="form-control @error('email')
                            is-invalid
                        @enderror"
                        name="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone</label>
                    <input id="phone_number"
                        type="text"
                        class="form-control @error('phone_number')
                            is-invalid
                        @enderror"
                        name="phone_number">
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <input id="role"
                        type="text"
                        class="form-control @error('role')
                            is-invalid
                        @enderror"
                        name="role">
                        @error('role')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="is_member">Member</label>
                    <input id="is_member"
                        type="text"
                        class="form-control @error('is_member')
                            is-invalid
                        @enderror"
                        name="is_member">
                        @error('is_member')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password"
                        class="d-block">Password</label>
                    <input id="password"
                        type="password"
                        class="form-control pwstrength @error('password')
                            is-invalid
                        @enderror"
                        data-indicator="pwindicator"
                        name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    <div id="pwindicator"
                        class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password2"
                        class="d-block">Password Confirmation</label>
                    <input id="password2"
                        type="password"
                        class="form-control @error('password_confirmation')
                            is-invalid
                        @enderror"
                        name="password_confirmation">
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="agree"
                            class="custom-control-input"
                            id="agree">
                        <label class="custom-control-label"
                            for="agree">I agree with the terms and conditions</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
