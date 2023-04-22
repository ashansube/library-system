@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <h2 class="alert alert-success">{{ session('message') }},</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard,</h2>
                <p class="mb-md-0">You can view your analytics here.</p>
                <hr>
            </div>

            <div class="row">
                <h4 class="mb-4 mt-3">Books Stall Orders</h4>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label class="mb-2">Total Book Stall Orders</label>
                        <h1>{{ $totalCartOrder }}</h1>
                        <a href="{{ url('admin/cartorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-2">Today Book Stall Orders</label>
                        <h1>{{ $todayCartOrder }}</h1>
                        <a href="{{ url('admin/cartorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-secondary text-white mb-3">
                        <label class="mb-2">This Month Book Stall Orders</label>
                        <h1>{{ $thisMonthCartOrder }}</h1>
                        <a href="{{ url('admin/cartorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label class="mb-2">This Year Book Stall Orders</label>
                        <h1>{{ $thisYearCartOrder }}</h1>
                        <a href="{{ url('admin/cartorders') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <h4 class="mb-4 mt-3">Library Orders</h4>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label class="mb-2">Total Library Book Orders</label>
                        <h1>{{ $totalReadlistOrder }}</h1>
                        <a href="{{ url('admin/readlistorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-2">Today Library Book Orders</label>
                        <h1>{{ $todayReadlistOrder }}</h1>
                        <a href="{{ url('admin/readlistorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-secondary text-white mb-3">
                        <label class="mb-2">This Month Library Book Orders</label>
                        <h1>{{ $thisMonthReadlistOrder }}</h1>
                        <a href="{{ url('admin/readlistorders') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                        <label class="mb-2">This Year Library Book Orders</label>
                        <h1>{{ $thisYearReadlistOrder }}</h1>
                        <a href="{{ url('admin/readlistorders') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <h4 class="mb-4 mt-3">Total Books - Categories - Publishers</h4>
                <div class="col-md-4">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label class="mb-2">Total Books</label>
                        <h1>{{ $totalBooks }}</h1>
                        <a href="{{ url('admin/books') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-info text-white mb-3">
                        <label class="mb-2">Total Categories</label>
                        <h1>{{ $totalCategories }}</h1>
                        <a href="{{ url('admin/category') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-2">Total Publishers</label>
                        <h1>{{ $totalPublishers }}</h1>
                        <a href="{{ url('admin/publishers') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <h4 class="mb-4 mt-3">Total Users - Admins</h4>
                <div class="col-md-4">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label class="mb-2">All User Count</label>
                        <h1>{{ $totalAllUsers }}</h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-info text-white mb-3">
                        <label class="mb-2">User Type: Users</label>
                        <h1>{{ $totalUser }}</h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-body bg-success text-white mb-3">
                        <label class="mb-2">User Type: Admin</label>
                        <h1>{{ $totalAdmin }}</h1>
                        <a href="{{ url('admin/users') }}" class="text-white">View</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
