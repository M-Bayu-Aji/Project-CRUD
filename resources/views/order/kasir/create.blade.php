@extends('templates.app')

@section('container-content')
    <div class="container mx-auto bg-white p-5">
        <h1 class="text-center mb-5 text-3xl md:text-4xl font-bold text-gray-800">
            <i class="ri-store-3-line mr-2 text-blue-600"></i>Thrift.Store
        </h1>

        @if (Session::get('success'))
            <div class="alert mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-between items-center"
                role="alert">
                <span>{{ Session::get('success') }}</span>
                <button type="button" class="btn-close ml-4" data-bs-dismiss="alert" aria-label="Close">
                    <span class="text-xl"></span>
                </button>
            </div>
        @endif

        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Product Image --}}
                <div class="w-full md:w-1/2 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105 cursor-pointer"
                        onclick="openImageModal(this.src)" />

                    <!-- Image Modal -->
                    <div id="imageModal"
                        class="fixed inset-0 z-[5000] bg-black bg-opacity-75 items-center justify-center hidden">
                        <div class="relative">
                            <img id="modalImage" src="" alt="Full size image"
                                class="object-cover w-full">
                            <button onclick="closeImageModal()"
                                class="absolute top-2 right-2 bg-white rounded-full p-2 text-gray-800 hover:bg-gray-200 transition-colors duration-200">
                                <i class="ri-close-line text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Product Details --}}
                <div class="w-full md:w-1/2 space-y-6">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                        <p class="text-2xl font-bold text-blue-600">
                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Quantity Control --}}
                    <div class="flex flex-col space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-medium text-gray-700">Quantity</span>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <button id="decrement" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition">-</button>
                                <input id="counter" type="number" min="1" value="1"
                                    class="w-16 text-center border-none outline-none text-blue-600" />
                                <button id="increment" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition">+</button>
                            </div>
                            <span class="text-sm text-gray-500">{{ $product->stock }} Tersedia</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="grid grid-cols-2 gap-4">
                        <form action="{{ route('payment.add_payment_page_cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="kty" id="kty_input" value="">
                            <input type="hidden" name="action" value="add_to_cart">
                            <button type="submit" id="add-to-cart"
                                class="w-full btn btn-outline-secondary flex items-center justify-center space-x-2 py-3 rounded-lg transition hover:bg-gray-300"
                                onclick="document.getElementById('kty_input').value = document.getElementById('counter').value;">
                                <i class="ri-shopping-cart-line"></i>
                                <span>Tambah Ke Keranjang</span>
                            </button>
                        </form>

                        <form action="{{ route('payment.add_payment_page_cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="hidden" name="kty" id="kty_input_buy_now" value="">
                            <input type="hidden" name="action" value="buy_now">
                            <button type="submit" class="w-full btn btn-primary py-3 rounded-lg transition"
                                onclick="document.getElementById('kty_input_buy_now').value = document.getElementById('counter').value;">
                                Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function openImageModal(imgSrc) {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('modalImage').src = imgSrc;
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Add ESC key listener
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const counterInput = document.getElementById("counter");
            const incrementBtn = document.getElementById("increment");
            const decrementBtn = document.getElementById("decrement");

            incrementBtn.addEventListener("click", () => {
                let currentValue = parseInt(counterInput.value) || 1;
                counterInput.value = currentValue + 1;
            });

            decrementBtn.addEventListener("click", () => {
                let currentValue = parseInt(counterInput.value) || 1;
                counterInput.value = Math.max(1, currentValue - 1);
            });

            // Auto-close alert
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });

            // Cart Animation (Optional: can be customized further)
            const addToCartBtn = document.getElementById('add-to-cart');
            const productImage = document.querySelector('img[alt="{{ $product->name }}"]');
            const navCartItem = document.querySelector('a[href="{{ route('payment.add_payment_page') }}"]');

            if (addToCartBtn && productImage && navCartItem) {
                addToCartBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const flyingCart = document.createElement('div');
                    flyingCart.innerHTML =
                        `<img src="{{ asset($product->image) }}" alt="" class="w-48 object-cover">`;
                    flyingCart.classList.add('fixed', 'z-50', 'transition-all', 'duration-1000',
                        'ease-in-out');

                    const startRect = productImage.getBoundingClientRect();
                    const endRect = navCartItem.getBoundingClientRect();

                    flyingCart.style.left = `${startRect.left + startRect.width / 2}px`;
                    flyingCart.style.top = `${startRect.top}px`;
                    document.body.appendChild(flyingCart);

                    requestAnimationFrame(() => {
                        flyingCart.style.left = `${endRect.left + endRect.width / 2}px`;
                        flyingCart.style.top = `${endRect.top}px`;
                        flyingCart.style.transform = 'scale(0.2)';
                        flyingCart.style.opacity = '0';
                    });

                    setTimeout(() => {
                        document.body.removeChild(flyingCart);
                        addToCartBtn.closest('form').submit();
                    }, 1000);
                });
            }
        });
    </script>
@endpush
