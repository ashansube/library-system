@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <div class="card shadow mb-2">
                    <div class="card-header" style="background-color: #90b1e5;">
                        <h4 class="mb-0 text-white">Change Password
                            <a href="{{ url('profile') }}" class="btn btn-sm text-white float-end" style="background-color: #F15A59;">Back</a>
                        </h4>
                    </div>
                    <div class="card-body mt-2">
                        <form action="{{ url('change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1">Current Password</label>
                                <input type="password" name="current_password" class="form-control" />
                                @error('current_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">New Password</label>
                                <input type="password" name="password" class="form-control" />
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="mb-1">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" />
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-primary" style="background-color: #90b1e5; border-color:#90b1e5;">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
