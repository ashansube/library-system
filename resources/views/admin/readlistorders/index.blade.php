@extends('layouts.admin')

@section('title', 'Read List Orders')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Read List Orders</h3>
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
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>In Progress</option>
                                    <option value="out for delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':'' }}>Out for Delivery</option>
                                    <option value="Issued" {{ Request::get('status') == 'issued' ? 'selected':'' }}>Issued</option>
                                    <option value="returned" {{ Request::get('status') == 'returned' ? 'selected':'' }}>Returned</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
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
                                    <th>Ordered Date / Issue</th>
                                    <th>Expected Return Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($readlistorders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tracking_no }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->expected_return_date }}</td>
                                        <td>{{ $item->status_message }}</td>
                                        <td><a href="{{ url('admin/readlistorders/' . $item->id) }}"
                                                class="btn btn-primary text-light">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No Orders Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $readlistorders->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
