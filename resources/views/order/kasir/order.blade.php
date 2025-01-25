<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Receipt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <!-- Header -->
        @if (Session::get('success'))
            <div class="alert mt-2 alert-success flex justify-between">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-700">Order Receipt</h1>
                <p class="text-sm text-gray-500">Thank you for your purchase!</p>
            </div>
            <div>
                <a href="{{ route('payment.payment_page') }}"
                    class="text-sm text-blue-600 hover:text-blue-800 font-medium">Back</a>
            </div>
        </div>

        <!-- Order Table -->
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 text-left px-4 py-2 font-medium text-gray-700">Product Name</th>
                    <th class="border border-gray-200 text-left px-4 py-2 font-medium text-gray-700">Quantity</th>
                    <th class="border border-gray-200 text-left px-4 py-2 font-medium text-gray-700">Price (per unit)
                    </th>
                    <th class="border border-gray-200 text-left px-4 py-2 font-medium text-gray-700">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($order['products'] as $product)
                    @php
                        $totalPrice = $product['kty'] * $product['price'];
                        $grandTotal += $totalPrice;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-200 px-4 py-2 text-gray-600">{{ $product['name'] }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-gray-600">{{ $product['kty'] }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-gray-600">Rp
                            {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-gray-600">Rp
                            {{ number_format($totalPrice, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer with Total -->
        <div class="mt-6 flex justify-end">
            <div class="text-right">
                <p class="text-lg font-semibold text-gray-700">Grand Total:</p>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Print Button -->
        <div class="mt-6 flex justify-center">
            <a href="{{ route('order.download_pdf', $order['id']) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Print PDF
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">If you have any questions about this receipt, please contact us at
                <span class="text-blue-600 font-medium">support@example.com</span>.
            </p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // Tambahkan script untuk alert auto-close
        $(document).ready(function() {
            // Otomatis close alert setelah 5 detik
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
</body>

</html>
