@extends('templates.app')

@section('container-content')
    <div class="container py-5 my-2.5 bg-white">
        <h1 class="tittle text-center font-bold text-3xl mb-10"><i class="ri-store-3-line"></i> Thrift.Store</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">

            <div class="flex mt-6">
                <a href="{{ route('payment.payment_page') }}"
                    class="bg-gray-200 w-1/6 text-center text-gray-800 py-2 rounded hover:bg-gray-300 cursor-pointer transition duration-300">Back</a>
            </div>

            @if (Session::get('success'))
                <div class="alert mt-2 alert-success flex justify-between">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="flex">
                <div
                    class="w-1/2 mt-2 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center p-4">
                    <img alt="Placeholder image for no image selected" class="mb-2 w-full h-full object-cover"
                        src="{{ asset($product->image) }}" />
                </div>
                <div class="w-1/2 p-4">
                    <!-- Informasi Produk -->
                    <div class="mb-4">
                        <h1 class="text-xl">{{ $product->name }}</h1>
                        <h1 class="text-xl font-semibold">Rp. {{ number_format($product->price, 0, ',', '.') }}</h1>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                    </div>

                    <!-- Input Kuantitas -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-semibold">Kuantitas</p>
                            <div class="flex items-center mt-2 border border-gray-300 rounded overflow-hidden w-fit">
                                <span id="decrement"
                                    class="w-12 h-12 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-black hover:cursor-pointer">
                                    <span class="text-2xl font-semibold">-</span>
                                </span>
                                <input id="counter" name="kty" type="number" value="1" min="1"
                                    class="w-16 h-12 text-center text-orange-500 text-xl border-none outline-none">
                                <span id="increment"
                                    class="w-12 h-12 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-black hover:cursor-pointer">
                                    <span class="text-2xl font-semibold">+</span>
                                </span>
                            </div>
                            <span class="text-gray-500 text-sm">{{ $product->stock }} buah tersedia</span>
                        </div>
                    </div>

                    <!-- Tombol Masukkan Keranjang -->
                    <div class="flex gap-2">
                        <form action="{{ route('payment.add_payment_page_cart') }}" method="post" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="kty" id="kty_input" value="1">
                            <input type="hidden" name="action" value="add_to_cart">
                            <button
                                class="w-full bg-gray-100 text-gray-800 py-2 rounded hover:bg-gray-200 transition duration-300 flex items-center justify-center"
                                type="submit">
                                <i class="ri-shopping-cart-line mr-2"></i>Masukkan Keranjang
                            </button>
                        </form>

                        <!-- Tombol Beli Sekarang -->
                        <form action="{{ route('payment.add_payment_page_cart') }}" method="post" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="kty" id="kty_input_buy_now" value="1">
                            <input type="hidden" name="action" value="buy_now">
                            <button
                                class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition duration-300"
                                type="submit">
                                Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            let counterInput = document.getElementById("counter");

            // Tombol Increment
            document
                .getElementById("increment")
                .addEventListener("click", function() {
                    let counter = parseInt(counterInput.value) || 1; // Pastikan nilai valid
                    counterInput.value = counter + 1;
                });

            // Tombol Decrement
            document
                .getElementById("decrement")
                .addEventListener("click", function() {
                    let counter = parseInt(counterInput.value) || 1; // Pastikan nilai valid
                    if (counter > 1) {
                        counterInput.value = counter - 1;
                    }
                });

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
