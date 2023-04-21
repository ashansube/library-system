<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Library Invoice #{{ $readlistorder->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
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

        table,
        th,
        td {
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

        .returndate-text {
            color: #F15A59;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .bottom-text {
            color: #F15A59;
            font-weight: 500;
            font-family: sans-serif;
        }
        .libarian-text{
            font-weight: 600;
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
                    <h4 class="text-start">Library Invoice</h4>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Library Invoice Id: #{{ $readlistorder->id }}</span> <br>
                    <span>{{ date('Y / m / d') }}</span> <br>
                    <span>Postel Code : 82270</span> <br>
                    <span>Address: Middeniya Public Library, Katuwana Pradeshiya Sabha, Middeniya Sub Office,
                        Middeniya</span> <br>
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
                <td>{{ $readlistorder->id }}</td>

                <td>Full Name:</td>
                <td>{{ $readlistorder->fullname }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $readlistorder->tracking_no }}</td>

                <td>Email Address:</td>
                <td>{{ $readlistorder->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ $readlistorder->created_at->format('Y-m-d h:i A') }}</td>

                <td>Phone:</td>
                <td>{{ $readlistorder->phone }}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{ $readlistorder->payment_mode }}</td>

                <td>Address:</td>
                <td>{{ $readlistorder->address }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $readlistorder->status_message }}</td>

                <td>Postel code:</td>
                <td>{{ $readlistorder->postelcode }}</td>
            </tr>
            <tr>
                <td>Expected Return Date:</td>
                <td class="returndate-text">{{ $readlistorder->expected_return_date }}</td>

                <td>Your Signature (Sign Here):</td>
                <td> </td>
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
                <th>Quantity</th>
                <th>Libraray Approval (Return)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($readlistorder->readlistorderItems as $readlistorderItem)
                <tr>
                    <td>{{ $readlistorderItem->id }}</td>
                    <td>
                        {{ $readlistorderItem->book->name }}
                    </td>
                    <td>{{ $readlistorderItem->quantity }}</td>
                    <td class="libarian-text text-center">Seal or Signature (Librarian)</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">Shipping: </td>
                <td colspan="1">Rs. 350</td>
            </tr>
            <tr>
                <td colspan="2">Service Charge: </td>
                <td colspan="1">Rs. 200</td>
            </tr>
            <tr>
                <td colspan="2" class="total-heading">Total Amount: </td>
                <td colspan="1" class="total-heading">Rs. {{ $totalPrice + 350 + 200 }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center bottom-text">
        When returning the books to the library, please ensure that you bring along this library invoice. Failure to
        present the invoice letter may result in an additional fee being charged. Thank you.
    </p>

</body>

</html>
