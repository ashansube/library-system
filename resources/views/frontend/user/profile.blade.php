@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mt-2">
                    <h4>User Profile
                        <a href="{{ url('change-password') }}"
                            class="btn btn-primary text-white float-end" style="background-color: #90b1e5; border-color:#90b1e5;">Change Password ?</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>

                <div class="col-md-10">

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header" style="background-color: #90b1e5;">
                            <h4 class="mb-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="mb-1">Username</label>
                                            <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control" />
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="mb-1">Email Address</label>
                                            <input type="text" readonly value="{{ Auth::user()->email }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="mb-1">Phone No</label>
                                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" />
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="mb-1">Postel Code</label>
                                            <input type="text" name="postel_code" value="{{ Auth::user()->userDetail->postel_code ?? '' }}" class="form-control" />
                                            @error('postel_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="mb-1">Address</label>
                                            <textarea name="address" class="form-control" rows="3">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end mb-3 mt-1" style="background-color: #90b1e5; border-color:#90b1e5;">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
