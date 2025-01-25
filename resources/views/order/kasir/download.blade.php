<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 0;
            color: #718096;
        }

        .back-link {
            text-decoration: none;
            color: #3182ce;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th, .order-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }

        .order-table th {
            background-color: #edf2f7;
        }

        .footer-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            margin-top: 20px;
        }

        .footer-total p {
            margin: 0;
            font-size: 18px;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }

        .print-button a {
            text-decoration: none;
            color: #fff;
            background-color: #3182ce;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #718096;
        }

        .footer span {
            color: #3182ce;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Order Receipt</h1>
                <p>Thank you for your purchase!</p>
            </div>
            <div>
                <a href="{{ route('payment.payment_page') }}" class="back-link">Back</a>
            </div>
        </div>

        <!-- Order Table -->
        <table class="order-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (per unit)</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($order['products'] as $product)
                    @php
                        $totalPrice = $product['kty'] * $product['price'];
                        $grandTotal += $totalPrice;
                    @endphp
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['kty'] }}</td>
                        <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer with Total -->
        <div class="footer-total">
            <div>
                <p>Grand Total:</p>
                <p>Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Print Button -->
        <div class="print-button">
            <a href="#">Print PDF</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you have any questions about this receipt, please contact us at
                <span>support@example.com</span>.
            </p>
        </div>
    </div>
</body>

</html>
