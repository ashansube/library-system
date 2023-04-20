@extends('layouts.app')

@section('title', 'My Readlist Order Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <h4 class="text-primary">
                            <i class="fa fa-book text-dark me-2"></i> My Readlist Order Details
                            <a href="{{ url('/readlistorders') }}" class="btn btn-danger btn-sm float-end text-light">Back</a>
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
                                <h6 class="border p-2 text-success mt-3">
                                    Order Status Message: <span
                                        class="text-uppercase">{{ $readlistorder->status_message }}</span>
                                </h6>
                                <h6 class="border p-2 text-danger mt-3">
                                    Expected Return Date: <span
                                        class="text-uppercase">{{ $readlistorder->expected_return_date }}</span>
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
                                        <th>Ordered Date</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice =0;
                                    @endphp
                                    @foreach ($readlistorder->readlistorderItems as $readlistorderItem)
                                        <tr>
                                            <td width="10%">{{ $readlistorderItem->id }}</td>
                                            <td width="10%">
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
                                            <td width="10%">{{ $readlistorderItem->created_at->format('Y-m-d') }}</td>
                                            <td width="10%">{{ $readlistorderItem->quantity }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">Shipping: </td>
                                        <td colspan="1">Rs. 350</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Service Charge: </td>
                                        <td colspan="1">Rs. 200</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="fw-bold">Total Amount: </td>
                                        <td colspan="1" class="fw-bold">
                                            Rs. {{ $totalPrice + 350 + 200 }}</td>
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
