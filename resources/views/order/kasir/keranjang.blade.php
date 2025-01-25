@extends('templates.app')

@section('container-content')
    <div class="container mx-auto px-4 pt-24 pb-72 bg-white">
        <h2 class="text-2xl mb-4 font-sans">Keranjang Belanja : <span class="font-bold">{{ Auth::user()->name }}</span></h2>
        @if (Session::get('success'))
            <div class="alert mt-2 alert-success flex justify-between">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="min-w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                @php
                    $grandTotal = 0;
                    foreach ($products as $order) {
                        if ($order->user_id == Auth::user()->id) {
                            $grandTotal += $order->total;
                        }
                    }
                @endphp
                @if ($products->isEmpty())
                    <div class="text-xl text-center text-gray-500"></div>
                @else
                    @if (Auth::check() && Auth::user()->id == $order->user_id)
                        <h4 class="text-xl block font-sans mb-4">Total: <span class="font-bold">Rp.
                                {{ number_format($grandTotal, 0, ',', '.') }}</span></h4>
                    @endif
                @endif

                <tr>
                    <th class="py-3 px-4 border-1 border-gray-300 text-center">Produk</th>
                    <th class="py-3 px-4 border-1 border-gray-300 text-center">Harga</th>
                    <th class="py-3 px-4 border-1 border-gray-300 text-center">Kuantitas</th>
                    <th class="py-3 px-4 border-1 border-gray-300 text-center">Total</th>
                    <th class="py-3 px-4 border-1 border-gray-300 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isEmpty())
                    <tr>
                        <td class="py-4 px-4 border text-center" colspan="5">Tidak ada pesanan</td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100">
                            @if ($product->user_id == Auth::user()->id)
                                <td class="py-4 px-4 border text-center">{{ $product->name }} {{ $product->image }}</td>
                                <td class="py-4 px-4 border text-center">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-4 px-4 border text-center">
                                    {{ $product->kty }}
                                </td>
                                <td class="py-4 px-4 border text-center">Rp.
                                    {{ number_format($product->total, 0, ',', '.') }}</td>
                                <td class="py-4 px-4 border text-center">
                                    <form action="{{ route('payment.delete_payment', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="mt-4">
            <div class="flex justify-between">
                <a href="{{ route('payment.payment_page') }}"
                    class="text-blue-500 border-1 rounded-md px-4 py-2 border-blue-800 hover:text-blue-700 hover:bg-gray-100">Back</a>
                <form action="{{ route('order.order_page2') }}">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
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
@endpush
