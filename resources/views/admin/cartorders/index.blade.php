@extends('layouts.admin')

@section('title', 'Book Stall Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Book Stall Orders</h3>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="mb-3">Filter By Ordered Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-3">Filter By Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select All Status</option>
                                    <option value="Pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                    <option value="In Progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>In Progress</option>
                                    <option value="Out for Delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':'' }}>Out for Delivery</option>
                                    <option value="Delivered" {{ Request::get('status') == 'delivered' ? 'selected':'' }}>Delivered</option>
                                    <option value="Completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                    <option value="Cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br/>
                                <button type="submit" class="btn btn-primary btn-sm mt-3 text-light">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartorders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{ url('admin/cartorders/' . $item->id) }}"
                                                class="btn btn-primary text-light">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Orders Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $cartorders->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
