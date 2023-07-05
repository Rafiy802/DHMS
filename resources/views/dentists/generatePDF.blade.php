    <!DOCTYPE html>
    <html>

    <head>
        <title>Invoice</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table td,
            table th {
                padding: 8px;
                border: 1px solid #ddd;
            }

            table th {
                text-align: left;
            }
        </style>
    </head>

    <body>
        <h1>Invoice</h1>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $Counter = 1;
                    $totalAll = 0;
                @endphp
                @foreach ($treatments as $treat)
                    <tr>
                        <th scope="row">{{ $Counter }}</th>
                        <td>{{ $treat->name }}</td>
                        <td>{{ $treat->price }}</td>
                        <td>1</td>
                        <td>{{ $treat->price }}</td>
                    </tr>
                    @php 
                    $Counter++; 
                    $totalAll += $treat->price;
                    @endphp
                @endforeach
                @foreach ($medicines as $med)
                    <tr>
                        <th scope="row">{{ $Counter }}</th>
                        <td>{{ $med->name }}</td>
                        <td>{{ $med->price }}</td>
                        <td>{{ $med->pivot->quantity }}</td>
                        @php
                            $total = $med->pivot->quantity * $med->price;
                            $totalAll += $total;
                        @endphp
                        <td>{{ number_format($total, 2) }}</td>
                    </tr>
                    @php $Counter++; @endphp
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Amount:</th>
                    <th>{{ number_format($totalAll, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </body>

    </html>
