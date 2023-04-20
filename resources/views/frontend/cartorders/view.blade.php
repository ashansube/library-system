@extends('layouts.app')

@section('title', 'My Order Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark me-2"></i> My Order Details
                            <a href="{{ url('/cartorders') }}" class="btn btn-danger btn-sm float-end text-light">Back</a>
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
                                    Order Status Message: <span
                                        class="text-uppercase">{{ $cartorder->status_message }}</span>
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
                                        $totalPrice =0;
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
                                            <td width="10%" class="fw-bold">Rs. {{ $cartorderItem->quantity * $cartorderItem->price}}</td>
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
            </div>
        </div>
    </div>

@endsection
