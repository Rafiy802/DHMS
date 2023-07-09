<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabcart</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-white">KLINIK ANAKITA</h1>
                </div>
                {{-- <div class="col-6">
                    <div class="company-details">
                        <p class="text-white">assdad asd  asda asdad a sd</p>
                        <p class="text-white">assdad asd asd</p>
                        <p class="text-white">+91 888555XXXX</p>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: {{ $receipt->id }}</h2>
                    {{-- <p class="sub-heading">Tracking No. fabcart2025 </p> --}}
                    <p class="sub-heading">Date: {{ $receipt->created_at }} </p>
                </div>
                <div class="col-6">
                    {{-- {{ $patient->name }} --}}
                    @foreach($patient as $pat)
                    <p class="sub-heading">Full Name: {{ $pat->patient_name }} </p>
                    @endforeach

{{-- 
                    <p class="sub-heading">Full Name: </p> 
                    <p class="sub-heading">Address:  </p>
                    <p class="sub-heading">Phone Number:  </p>
                    <p class="sub-heading">City,State,Pincode:  </p> --}}
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    // $Counter = 1;
                    $totalAll = 0;
                @endphp
                @foreach ($treatments as $treat)
                    <tr>
                        {{-- <th scope="row">{{ $Counter }}</th> --}}
                        <td>{{ $treat->name }}</td>
                        <td>{{ $treat->price }}</td>
                        <td>1</td>
                        <td>{{ $treat->price }}</td>
                    </tr>
                    @php 
                    // $Counter++; 
                    $totalAll += $treat->price;
                    @endphp
                @endforeach
                @foreach ($medicines as $med)
                    <tr>
                        {{-- <th scope="row">{{ $Counter }}</th> --}}
                        <td>{{ $med->name }}</td>
                        <td>{{ $med->price }}</td>
                        <td>{{ $med->pivot->quantity }}</td>
                        @php
                            $total = $med->pivot->quantity * $med->price;
                            $totalAll += $total;
                        @endphp
                        <td>{{ number_format($total, 2) }}</td>
                    </tr>
                    {{-- @php $Counter++; @endphp --}}
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Amount:</th>
                        <th>{{ number_format($totalAll, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
            <br>
            {{-- <h3 class="heading">Payment Status: Paid</h3>
            <h3 class="heading">Payment Mode: Cash on Delivery</h3> --}}
        </div>

        {{-- <div class="body-section">
            <p>&copy; Copyright 2021 - Fabcart. All rights reserved. 
                <a href="https://www.fundaofwebit.com/" class="float-right">www.fundaofwebit.com</a>
            </p>
        </div>       --}}
    </div>      

</body>
</html>