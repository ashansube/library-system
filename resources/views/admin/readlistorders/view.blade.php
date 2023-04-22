@extends('layouts.admin')

@section('title', 'Read List Order Details')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success mb-3">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Read List Order Details</h3>
                </div>
                <div class="card-body">



                    <h4 class="text-primary">
                        <i class="mdi mdi-book-multiple text-dark me-2"></i> My Read List Order Details
                        <a href="{{ url('admin/readlistorders') }}" class="btn btn-danger btn-sm float-end text-light">Back</a>
                        <a href="{{ url('admin/readlistinvoice/'.$readlistorder->id.'/generate') }}" class="btn btn-dark btn-sm float-end text-light mx-1">Download Invoice</a>
                        <a href="{{ url('admin/readlistinvoice/'.$readlistorder->id) }}" target="_blank" class="btn btn-primary btn-sm float-end text-light mx-1">View Invoice</a>
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order Id: {{ $readlistorder->id }}</h6>
                            <h6>Tracking Id/No.: {{ $readlistorder->tracking_no }}</h6>
                            <h6>Ordered Date: {{ $readlistorder->created_at->format('Y-m-d h:i A') }}</h6>
                            <h6>Payment Mode: {{ $readlistorder->payment_mode }}</h6>
                            <h6 class="border p-2 text-danger mt-3">
                                Expected Return Date: <span class="text-uppercase">{{ $readlistorder->expected_return_date }}</span>
                            </h6>
                            <h6 class="border p-2 text-success mt-3">
                                Order Status Message: <span class="text-uppercase">{{ $readlistorder->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{ $readlistorder->fullname }}</h6>
                            <h6>Email Address: {{ $readlistorder->email }}</h6>
                            <h6>Phone: {{ $readlistorder->phone }}</h6>
                            <h6>Address: {{ $readlistorder->address }}</h6>
                            <h6>Postel Code: {{ $readlistorder->postelcode }}</h6>
                        </div>
                    </div>

                    <br />
                    <h5>Order Items</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Image</th>
                                    <th>Book</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($readlistorder->readlistorderItems as $readlistorderItem)
                                    <tr>
                                        <td width="10%">{{ $readlistorderItem->id }}</td>
                                        <td width="20%">
                                            @if ($readlistorderItem->book->bookImages)
                                                <img src="{{ asset($readlistorderItem->book->bookImages[0]->image) }}"
                                                    style="width: 50px; height: 50px" alt="readlist item image">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $readlistorderItem->book->name }}
                                        </td>
                                        <td>{{ $readlistorderItem->quantity }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">Shipping: </td>
                                    <td colspan="1">Rs. 350</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Service Charge: </td>
                                    <td colspan="1">Rs. 200</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="fw-bold">Total Amount: </td>
                                    <td colspan="1" class="fw-bold">
                                        Rs. {{ $totalPrice + 350 + 200 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

            <div class="card border mt-3 mb-5">
                <div class="card-body">
                    <h4>Order Process (Order Status Updates)</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ url('admin/readlistorders/'.$readlistorder->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <label class="mb-3">Update Your Order Status</label>
                                <div class="input-group">
                                    <select name="readlistorder_status" class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="Pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                        <option value="In Progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>In Progress</option>
                                        <option value="Out for Delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':'' }}>Out for Delivery</option>
                                        <option value="Issued" {{ Request::get('status') == 'issued' ? 'selected':'' }}>Issued</option>
                                        <option value="Returned" {{ Request::get('status') == 'returned' ? 'selected':'' }}>Returned</option>
                                        <option value="Completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                        <option value="Cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-7">
                            <br/>
                            <h4 class="mt-4 mb-5 text-primary">Current Order Status: <span class="text-uppercase">{{ $readlistorder->status_message }}</span> </h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
