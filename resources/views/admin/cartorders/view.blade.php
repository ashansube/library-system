@extends('layouts.admin')

@section('title', 'Book Stall Order Details')

@section('content')

    <div class="row">
        <div class="col-md-12">

            @if (session('message'))
                <div class="alert alert-success mb-3">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Book Stall Order Details</h3>
                </div>
                <div class="card-body">



                    <h4 class="text-primary">
                        <i class="mdi mdi-shopping text-dark me-2"></i> My Order Details
                        <a href="{{ url('admin/cartorders') }}" class="btn btn-danger btn-sm float-end text-light">Back</a>
                    </h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order Id: {{ $cartorder->id }}</h6>
                            <h6>Tracking Id/No.: {{ $cartorder->tracking_no }}</h6>
                            <h6>Ordered Date: {{ $cartorder->created_at->format('Y-m-d h:i A') }}</h6>
                            <h6>Payment Mode: {{ $cartorder->payment_mode }}</h6>
                            <h6 class="border p-2 text-success mt-3">
                                Order Status Message: <span class="text-uppercase">{{ $cartorder->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{ $cartorder->fullname }}</h6>
                            <h6>Email Address: {{ $cartorder->email }}</h6>
                            <h6>Phone: {{ $cartorder->phone }}</h6>
                            <h6>Address: {{ $cartorder->address }}</h6>
                            <h6>Postel Code: {{ $cartorder->postelcode }}</h6>
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
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($cartorder->cartorderItems as $cartorderItem)
                                    <tr>
                                        <td width="10%">{{ $cartorderItem->id }}</td>
                                        <td width="10%">
                                            @if ($cartorderItem->book->bookImages)
                                                <img src="{{ asset($cartorderItem->book->bookImages[0]->image) }}"
                                                    style="width: 50px; height: 50px" alt="cart item image">
                                            @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $cartorderItem->book->name }}
                                        </td>
                                        <td width="10%">Rs. {{ $cartorderItem->price }}</td>
                                        <td width="10%">{{ $cartorderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">Rs.
                                            {{ $cartorderItem->quantity * $cartorderItem->price }}</td>
                                        @php
                                            $totalPrice += $cartorderItem->quantity * $cartorderItem->price;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">Shipping: </td>
                                    <td colspan="1">Rs. 350</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amount: </td>
                                    <td colspan="1" class="fw-bold">
                                        Rs. {{ $totalPrice + 350 }}</td>
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
                            <form action="{{ url('admin/cartorders/'.$cartorder->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <label class="mb-3">Update Your Order Status</label>
                                <div class="input-group">
                                    <select name="cartorder_status" class="form-select">
                                        <option value="">Select Order Status</option>
                                        <option value="In Progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>In Progress</option>
                                        <option value="Completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                        <option value="Pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                        <option value="Cancelled" {{ Request::get('status') == 'cancelled' ? 'selected':'' }}>Cancelled</option>
                                        <option value="Out for Delivery" {{ Request::get('status') == 'out for delivery' ? 'selected':'' }}>Out for Delivery</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-7">
                            <br/>
                            <h4 class="mt-4 mb-5 text-primary">Current Order Status: <span class="text-uppercase">{{ $cartorder->status_message }}</span> </h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
