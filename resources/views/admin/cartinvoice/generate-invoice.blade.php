<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Book Stall Invoice #{{ $cartorder->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #7ba5e7;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Middeniya P. Library</h2>
                    <h4 class="text-start">Book Stall Invoice</h4>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Book Stall Invoice Id: #{{ $cartorder->id }}</span> <br>
                    <span>{{ date('Y / m / d') }}</span> <br>
                    <span>Postel Code : 82270</span> <br>
                    <span>Address: Middeniya Public Library, Katuwana Pradeshiya Sabha, Middeniya Sub Office, Middeniya</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>{{ $cartorder->id }}</td>

                <td>Full Name:</td>
                <td>{{ $cartorder->fullname }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $cartorder->tracking_no }}</td>

                <td>Email Address:</td>
                <td>{{ $cartorder->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $cartorder->created_at->format('Y-m-d h:i A') }}</td>

                <td>Phone:</td>
                <td>{{ $cartorder->phone }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{ $cartorder->payment_mode }}</td>

                <td>Address:</td>
                <td>{{ $cartorder->address }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $cartorder->status_message }}</td>

                <td>Postel code:</td>
                <td>{{ $cartorder->postelcode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
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
                    <td>
                        {{ $cartorderItem->book->name }}
                    </td>
                    <td width="10%">Rs. {{ $cartorderItem->price }}</td>
                    <td width="10%">{{ $cartorderItem->quantity }}</td>
                    <td width="15%" class="fw-bold">Rs.
                        {{ $cartorderItem->quantity * $cartorderItem->price }}</td>
                    @php
                        $totalPrice += $cartorderItem->quantity * $cartorderItem->price;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Shipping: </td>
                <td colspan="1">Rs. 350</td>
            </tr>
            <tr>
                <td colspan="4" class="total-heading">Total Amount: </td>
                <td colspan="1" class="total-heading">
                    Rs. {{ $totalPrice + 350 }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Stay connected with us.
    </p>

</body>
</html>
