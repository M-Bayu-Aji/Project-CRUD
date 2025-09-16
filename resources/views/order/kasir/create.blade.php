@extends('templates.app')

@section('container-content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
        <div class="px-4 py-8 mx-auto max-w-7xl">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <h1 class="mb-4 text-4xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text">
                    <i class="mr-3 text-blue-600 fas fa-store"></i>ThriftStore
                </h1>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Detail produk pilihan Anda
                </p>
                <div class="w-24 h-1 mx-auto mt-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
            </div>

            @if (Session::get('success'))
                <div id="success-alert"
                    class="relative flex items-center justify-between px-6 py-4 mb-6 text-green-700 border border-green-200 shadow-lg bg-green-50 rounded-2xl backdrop-blur-sm bg-white/80 alert animate-slideIn"
                    role="alert">
                    <div class="flex items-center">
                        <i class="mr-3 text-xl text-green-500 fas fa-check-circle"></i>
                        <span class="font-medium">{{ Session::get('success') }}</span>
                    </div>
                    <button type="button" class="ml-4 text-green-700 transition-colors hover:text-green-900"
                        onclick="closeAlert()" aria-label="Close">
                        <i class="text-lg fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Product Detail Container -->
            <div
                class="overflow-hidden border shadow-xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 animate-fadeInUp">
                <div class="p-8">
                    <div class="flex flex-col gap-8 lg:flex-row">
                        {{-- Product Image Section --}}
                        <div class="w-full lg:w-1/2">
                            <div class="relative group">
                                <div
                                    class="overflow-hidden shadow-lg aspect-square rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="object-cover w-full h-full transition-all duration-500 cursor-pointer group-hover:scale-110"
                                        onclick="openImageModal(this.src)" />
                                    <!-- Hover Overlay -->
                                    <div
                                        class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 opacity-0 bg-black/20 group-hover:opacity-100">
                                        <div class="text-center text-white">
                                            <i class="mb-2 text-3xl fas fa-search-plus"></i>
                                            <p class="text-sm font-medium">Klik untuk memperbesar</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Premium Badge -->
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-white rounded-full shadow-lg bg-gradient-to-r from-blue-500 to-purple-500">
                                        <i class="mr-1 fas fa-star"></i>Premium
                                    </span>
                                </div>
                            </div>

                            <!-- Image Modal -->
                            <div id="imageModal"
                                class="fixed inset-0 z-[5000] bg-black/80 backdrop-blur-sm items-center justify-center hidden transition-all duration-300">
                                <div class="relative max-w-4xl max-h-[90vh] p-4">
                                    <img id="modalImage" src="" alt="Full size image"
                                        class="object-contain w-full h-full shadow-2xl rounded-2xl">
                                    <button onclick="closeImageModal()"
                                        class="absolute p-3 text-gray-800 transition-all duration-200 rounded-full shadow-lg -top-2 -right-2 bg-white/90 backdrop-blur-sm hover:bg-white hover:scale-110">
                                        <i class="text-xl fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Product Details Section --}}
                        <div class="w-full space-y-8 lg:w-1/2">
                            <!-- Product Info -->
                            <div class="space-y-4">
                                <div>
                                    <h2 class="mb-3 text-3xl font-bold leading-tight text-gray-800">{{ $product->name }}
                                    </h2>
                                    <div class="flex items-center gap-4 mb-4">
                                        <span class="text-4xl font-bold text-green-600">
                                            Rp {{ number_format($product->price, 0, '.', '.') }}
                                        </span>
                                        <span
                                            class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                            <i class="mr-1 fas fa-check-circle"></i>Tersedia
                                        </span>
                                    </div>
                                </div>

                                <!-- Stock Info -->
                                <div
                                    class="flex items-center gap-3 p-4 border border-blue-100 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-xl">
                                        <i class="text-white fas fa-boxes"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Stok tersedia</p>
                                        <p class="text-lg font-bold text-blue-600">{{ $product->stock }} unit</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Quantity Control --}}
                            <div class="space-y-4">
                                <h3 class="flex items-center text-lg font-semibold text-gray-800">
                                    <i class="mr-2 text-purple-600 fas fa-calculator"></i>Pilih Jumlah
                                </h3>
                                <div
                                    class="flex items-center justify-between p-4 border border-gray-200 bg-gray-50 rounded-2xl">
                                    <span class="font-medium text-gray-700">Quantity</span>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex items-center overflow-hidden bg-white border border-gray-300 shadow-sm rounded-xl">
                                            <button id="decrement"
                                                class="flex items-center justify-center px-4 py-3 transition-all duration-300 bg-gray-100 hover:bg-red-100 hover:text-red-600">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input id="counter" type="number" min="1" value="1"
                                                class="w-16 py-3 text-lg font-bold text-center text-blue-600 border-none outline-none" />
                                            <button id="increment"
                                                class="flex items-center justify-center px-4 py-3 transition-all duration-300 bg-gray-100 hover:bg-green-100 hover:text-green-600">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="space-y-4">
                                <h3 class="flex items-center text-lg font-semibold text-gray-800">
                                    <i class="mr-2 text-blue-600 fas fa-shopping-cart"></i>Pilih Aksi
                                </h3>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <!-- Add to Cart Button -->
                                    <form action="{{ route('payment.add_payment_page_cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="kty" id="kty_input" value="">
                                        <input type="hidden" name="action" value="add_to_cart">
                                        <button type="submit" id="add-to-cart"
                                            class="flex items-center justify-center w-full gap-3 px-6 py-4 font-semibold text-gray-700 transition-all duration-300 bg-white border-2 border-gray-300 rounded-2xl hover:border-blue-500 hover:text-blue-600 hover:shadow-lg hover:scale-105 group"
                                            onclick="document.getElementById('kty_input').value = document.getElementById('counter').value;">
                                            <i class="fas fa-cart-plus group-hover:animate-bounce"></i>
                                            <span>Tambah ke Keranjang</span>
                                        </button>
                                    </form>

                                    <!-- Buy Now Button -->
                                    <form action="{{ route('payment.add_payment_page_cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="kty" id="kty_input_buy_now" value="">
                                        <input type="hidden" name="action" value="buy_now">
                                        <button type="submit"
                                            class="flex items-center justify-center w-full gap-3 px-6 py-4 font-semibold text-white transition-all duration-300 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl hover:shadow-xl hover:scale-105 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25 group"
                                            onclick="document.getElementById('kty_input_buy_now').value = document.getElementById('counter').value;">
                                            <i class="fas fa-bolt group-hover:animate-pulse"></i>
                                            <span>Beli Sekarang</span>
                                            <i
                                                class="transition-transform duration-300 fas fa-arrow-right group-hover:translate-x-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        // Alert functions
        function closeAlert() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'all 0.3s ease-out';
                alert.style.transform = 'translateY(-10px)';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        function openImageModal(imgSrc) {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('modalImage').src = imgSrc;

            // Add animation
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.querySelector('img').style.transform = 'scale(1)';
            }, 10);
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.opacity = '0';
            modal.querySelector('img').style.transform = 'scale(0.9)';

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
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
    const alert = document.getElementById('success-alert');
    if (alert) {
        setTimeout(() => {
            closeAlert();
        }, 5000);
    }
});

    </script>
@endpush

@push('style')
    <style>
        /* Custom animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }


        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-fadeInUp {
            opacity: 0 !important;
            transform: translateY(30px) !important;
            animation: fadeInUp 0.8s ease-out;
        }

        /* Modal animations */
        #imageModal {
            opacity: 0;
            transition: opacity 0.3s ease-out;
        }

        #imageModal img {
            transform: scale(0.9);
            transition: transform 0.3s ease-out;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Button hover effects */
        button:active {
            transform: scale(0.98);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
        }

        /* Input number styling */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
