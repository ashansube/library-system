@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Send SMS
                        <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/users/sendsms') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">Phone Number (Please Remove '0' and Add 94 before sending SMS)</label>
                                <input type="text" id="to" name="to" value="{{ $user->phone }}" class="form-control">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="mb-2">SMS Message</label>
                                <textarea id="text" name="text" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary text-light">Send SMS</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
