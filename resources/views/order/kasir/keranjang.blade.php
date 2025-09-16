@extends('templates.app')

@section('container-content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50">
        <!-- Header Section -->
        <div class="px-4 py-8 mx-auto max-w-7xl">
            <div class="mb-8 text-center">
                <h1 class="mb-4 text-4xl font-bold text-transparent bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text">
                    <i class="mr-3 text-blue-600 fas fa-shopping-cart"></i>Keranjang Belanja
                </h1>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Kelola produk favorit Anda sebelum melanjutkan ke pembayaran
                </p>
                <div class="w-24 h-1 mx-auto mt-4 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
            </div>

            @if (Session::get('success'))
                <div class="relative flex items-center justify-between px-6 py-4 mb-6 text-green-700 border border-green-200 shadow-lg bg-green-50 rounded-2xl backdrop-blur-sm bg-white/80 alert animate-slideIn"
                    role="alert">
                    <div class="flex items-center">
                        <i class="mr-3 text-xl text-green-500 fas fa-check-circle"></i>
                        <span class="font-medium">{{ Session::get('success') }}</span>
                    </div>
                    <button type="button" class="ml-4 text-green-700 transition-colors hover:text-green-900 btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="text-lg fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if ($products->isEmpty())
                <div class="flex flex-col items-center justify-center min-h-[500px] py-16 px-4">
                    <div class="w-full max-w-lg space-y-8 text-center">
                        <!-- Empty Cart Animation -->
                        <div class="relative animate-float">
                            <div class="flex items-center justify-center w-32 h-32 mx-auto rounded-full shadow-xl bg-gradient-to-br from-blue-100 to-purple-100">
                                <i class="text-6xl text-gray-400 fas fa-shopping-cart"></i>
                            </div>
                            <div class="absolute flex items-center justify-center w-8 h-8 bg-red-500 rounded-full -top-2 -right-2 animate-pulse">
                                <i class="text-sm text-white fas fa-exclamation"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h1 class="text-3xl font-bold text-gray-800">
                                Keranjang Belanjamu Kosong
                            </h1>
                            <p class="max-w-sm mx-auto text-lg leading-relaxed text-gray-600">
                                Yuk, telusuri koleksi ThriftStore kami dan temukan barang impianmu!
                            </p>
                            <div class="mt-8">
                                <a href="{{ route('payment.payment_page') }}"
                                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white transition-all duration-300 shadow-xl group bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl hover:shadow-2xl hover:scale-105 hover:-translate-y-1">
                                    <i class="mr-3 fas fa-store group-hover:animate-bounce"></i>
                                    <span>Mulai Belanja</span>
                                    <i class="ml-3 transition-transform duration-300 fas fa-arrow-right group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <form action="{{ route('order.order_page2') }}" method="POST" class="mx-auto max-w-7xl">
                @csrf
                <div class="grid grid-cols-1 gap-8 xl:grid-cols-12">
                    <!-- Cart Items Section -->
                    <div class="space-y-6 xl:col-span-8">
                        <div class="p-8 border shadow-xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-bold text-gray-800">
                                    <i class="mr-3 text-blue-600 fas fa-list-ul"></i>Produk dalam Keranjang
                                </h2>
                                <span class="px-4 py-2 font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl">
                                    {{ count($products) }} Items
                                </span>
                            </div>

                            <div class="space-y-6">
                                @foreach ($products as $product)
                                    <div class="p-6 transition-all duration-300 bg-white border border-gray-100 shadow-lg group rounded-2xl hover:shadow-xl hover:-translate-y-1"
                                         data-price="{{ $product->price }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center">
                                            <!-- Checkbox and Image -->
                                            <div class="flex items-center gap-4">
                                                <div class="relative">
                                                    <input type="checkbox"
                                                           class="relative z-10 w-5 h-5 text-blue-600 transition-all duration-300 bg-gray-100 border-gray-300 rounded item-checkbox focus:ring-blue-500 focus:ring-2"
                                                           name="selected_products[]" value="{{ $product->id }}">
                                                    <div class="absolute inset-0 transition-opacity duration-300 bg-blue-500 rounded opacity-0 pointer-events-none group-hover:opacity-20"></div>
                                                </div>
                                                <div class="relative w-24 h-24 overflow-hidden shadow-lg bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl lg:w-28 lg:h-28">
                                                    <img src="{{ asset($product->image) }}"
                                                         alt="{{ $product->name }}"
                                                         class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                                                    <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/20 to-transparent group-hover:opacity-100"></div>
                                                </div>
                                            </div>

                                            <!-- Product Info -->
                                            <div class="flex-1 space-y-3">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-800 transition-colors duration-300 group-hover:text-blue-600">
                                                        {{ $product->name }}
                                                    </h3>
                                                    <div class="flex items-center gap-3 mt-2">
                                                        <span class="text-lg font-semibold text-gray-700">
                                                            Rp {{ number_format($product->price, 0, '.', '.') }}
                                                        </span>
                                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                                            <i class="mr-1 fas fa-check-circle"></i>Tersedia
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-lg font-bold text-blue-600 subtotal">
                                                    Subtotal: Rp {{ number_format($product->price, 0, '.', '.') }}
                                                </div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center justify-between gap-4 lg:justify-end">
                                                <div class="flex items-center gap-3 p-2 border border-gray-200 bg-gray-50 rounded-2xl">
                                                    <button type="button"
                                                        class="flex items-center justify-center w-10 h-10 transition-all duration-300 bg-white border border-gray-300 shadow-sm decrement rounded-xl hover:bg-red-50 hover:border-red-300 hover:text-red-600">
                                                        <i class="text-sm fas fa-minus"></i>
                                                    </button>
                                                    <input type="number"
                                                           class="w-16 text-lg font-bold text-center bg-transparent border-none quantity focus:outline-none focus:ring-0"
                                                           name="quantity[{{ $product->id }}]"
                                                           value="1" min="1" max="999">
                                                    <button type="button"
                                                        class="flex items-center justify-center w-10 h-10 transition-all duration-300 bg-white border border-gray-300 shadow-sm increment rounded-xl hover:bg-green-50 hover:border-green-300 hover:text-green-600">
                                                        <i class="text-sm fas fa-plus"></i>
                                                    </button>
                                                </div>

                                                <button type="button"
                                                    class="flex items-center gap-2 px-4 py-2 text-white transition-all duration-300 shadow-lg btn-delete bg-gradient-to-r from-red-500 to-red-600 rounded-xl hover:from-red-600 hover:to-red-700 hover:scale-105"
                                                    data-id="{{ $product->id }}">
                                                    <i class="text-sm fas fa-trash"></i>
                                                    <span class="hidden sm:inline">Hapus</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary Section -->
                    <div class="xl:col-span-4">
                        <div class="sticky p-8 border shadow-xl bg-white/80 backdrop-blur-sm rounded-3xl border-white/20 top-8">
                            <div class="mb-8 text-center">
                                <h2 class="mb-2 text-2xl font-bold text-gray-800">
                                    <i class="mr-3 text-purple-600 fas fa-receipt"></i>Ringkasan Belanja
                                </h2>
                                <div class="h-0.5 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mx-auto"></div>
                            </div>

                            <div class="mb-8 space-y-6">
                                <!-- Total Items -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-500 rounded-xl">
                                            <i class="text-white fas fa-shopping-bag"></i>
                                        </div>
                                        <span class="font-medium text-gray-700">Total Barang</span>
                                    </div>
                                    <span id="totalItems" class="text-xl font-bold text-blue-600 transition-all duration-300">0 items</span>
                                </div>

                                <!-- Total Price -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl">
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-green-500 rounded-xl">
                                            <i class="text-white fas fa-money-bill-wave"></i>
                                        </div>
                                        <span class="font-medium text-gray-700">Total Harga</span>
                                    </div>
                                    <span class="text-xl font-bold text-green-600 transition-all duration-300" id="totalPrice">Rp 0</span>
                                </div>

                                <!-- Discount Info -->
                                {{-- <div class="p-4 border border-yellow-200 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-yellow-600 fas fa-tag"></i>
                                        <div>
                                            <p class="text-sm font-medium text-yellow-800">Promo Tersedia!</p>
                                            <p class="text-xs text-yellow-700">Gratis ongkir untuk pembelian > Rp 100.000</p>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-4">
                                <!-- Delete Selected Button -->
                                <button type="button" id="deleteSelectedItems"
                                    class="w-full py-4 font-semibold text-white transition-all duration-300 group bg-gradient-to-r from-red-500 to-red-600 rounded-2xl hover:from-red-600 hover:to-red-700 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-500/25">
                                    <span class="flex items-center justify-center">
                                        <i class="mr-2 fas fa-trash group-hover:animate-bounce"></i>
                                        Hapus <span id="totalSelectedItems"></span>
                                    </span>
                                </button>

                                <!-- Checkout Button -->
                                <button type="submit"
                                    class="w-full py-4 font-semibold text-white transition-all duration-300 group bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl hover:from-blue-700 hover:to-purple-700 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/25"
                                    id="checkout" disabled>
                                    <span class="flex items-center justify-center">
                                        <i class="mr-2 fas fa-credit-card group-hover:animate-pulse"></i>
                                        Lanjut ke Pembayaran
                                        <i class="ml-2 transition-transform duration-300 fas fa-arrow-right group-hover:translate-x-1"></i>
                                    </span>
                                </button>

                                <!-- Continue Shopping -->
                                <a href="{{ route('payment.payment_page') }}"
                                   class="block w-full py-3 font-medium text-center text-gray-700 transition-all duration-300 bg-gray-100 hover:bg-gray-200 rounded-2xl hover:scale-105">
                                    <i class="mr-2 fas fa-store"></i>
                                    Lanjut Belanja
                                </a>
                            </div>

                            <!-- Security Badge -->
                            <div class="p-3 mt-6 text-center bg-gray-50 rounded-2xl">
                                <div class="flex items-center justify-center text-sm text-gray-600">
                                    <i class="mr-2 text-green-500 fas fa-shield-alt"></i>
                                    Pembayaran aman & terpercaya
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
            @foreach ($products as $product)
                <form id="delete-form-{{ $product->id }}" action="{{ route('payment.delete_payment', $product->id) }}"
                    method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            <form id="deleteSelectedForm" action="{{ route('payment.delete_selected') }}" method="POST"
                class="hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_items" id="selectedItemsInput">
            </form>
        </div>
    </div>

    <!-- Custom Styles and Animations -->
    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease-out;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
        }

        /* Button disabled state */
        button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Loading animation for quantity changes */
        .quantity-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        /* Smooth transitions for all interactive elements */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hover effects for cards */
        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }
    </style>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Enhanced auto-close alerts with animation
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").addClass('opacity-0 transform -translate-y-2').delay(300).queue(function() {
                    $(this).slideUp(500, function() {
                        $(this).remove();
                    });
                });
            }, 5000);
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Enhanced delete button functionality with modern SweetAlert
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    Swal.fire({
                        title: "Hapus Item?",
                        text: "Item ini akan dihapus dari keranjang belanja Anda",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#ef4444",
                        cancelButtonColor: "#6b7280",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal",
                        background: '#ffffff',
                        backdrop: 'rgba(0,0,0,0.4)',
                        customClass: {
                            popup: 'rounded-3xl shadow-2xl',
                            title: 'text-2xl font-bold text-gray-800',
                            content: 'text-gray-600',
                            confirmButton: 'px-6 py-3 rounded-2xl font-semibold',
                            cancelButton: 'px-6 py-3 rounded-2xl font-semibold'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Add loading effect to the button
                            this.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Menghapus...';
                            this.disabled = true;

                            Swal.fire({
                                title: "Berhasil!",
                                text: "Item telah dihapus dari keranjang",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false,
                                background: '#ffffff',
                                customClass: {
                                    popup: 'rounded-3xl shadow-2xl',
                                    title: 'text-2xl font-bold text-gray-800'
                                }
                            });

                            // Submit form after delay
                            setTimeout(() => {
                                document.getElementById(`delete-form-${id}`).submit();
                            }, 500);
                        }
                    });
                });
            });

            // Enhanced delete selected items functionality
            document.getElementById('deleteSelectedItems').addEventListener('click', function() {
                const selectedItems = document.querySelectorAll('.item-checkbox:checked');
                if (selectedItems.length === 0) {
                    Swal.fire({
                        title: "Tidak ada item yang dipilih",
                        text: "Silakan pilih item yang ingin dihapus terlebih dahulu",
                        icon: "info",
                        confirmButtonColor: "#3b82f6",
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-3xl shadow-2xl',
                            title: 'text-2xl font-bold text-gray-800',
                            content: 'text-gray-600',
                            confirmButton: 'px-6 py-3 rounded-2xl font-semibold'
                        },
                        buttonsStyling: false
                    });
                    return;
                }

                Swal.fire({
                    title: `Hapus ${selectedItems.length} Item?`,
                    text: "Item yang dipilih akan dihapus dari keranjang belanja",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ef4444",
                    cancelButtonColor: "#6b7280",
                    confirmButtonText: "Ya, Hapus Semua!",
                    cancelButtonText: "Batal",
                    background: '#ffffff',
                    backdrop: 'rgba(0,0,0,0.4)',
                    customClass: {
                        popup: 'rounded-3xl shadow-2xl',
                        title: 'text-2xl font-bold text-gray-800',
                        content: 'text-gray-600',
                        confirmButton: 'px-6 py-3 rounded-2xl font-semibold',
                        cancelButton: 'px-6 py-3 rounded-2xl font-semibold'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Add loading effect
                        this.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Menghapus...';
                        this.disabled = true;

                        // Collect selected IDs
                        const selectedIds = [];
                        selectedItems.forEach(checkbox => {
                            selectedIds.push(checkbox.value);
                        });
                        document.getElementById('selectedItemsInput').value = selectedIds.join(',');

                        // Add fade out animation to selected items
                        selectedItems.forEach(checkbox => {
                            const item = checkbox.closest('[data-price]');
                            item.style.transition = 'all 0.5s ease';
                            item.style.opacity = '0';
                            item.style.transform = 'translateX(-100px)';
                        });

                        // Submit form and show success
                        setTimeout(() => {
                            document.getElementById('deleteSelectedForm').submit();

                            Swal.fire({
                                title: "Berhasil!",
                                text: `${selectedItems.length} item telah dihapus`,
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false,
                                background: '#ffffff',
                                customClass: {
                                    popup: 'rounded-3xl shadow-2xl',
                                    title: 'text-2xl font-bold text-gray-800'
                                }
                            });
                        }, 600);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const paymentButton = document.querySelector('#checkout');
            const selectedButton = document.querySelector('#deleteSelectedItems');

            // Enhanced number formatting
            function formatIDR(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            }

            // Enhanced subtotal update with animation
            function updateSubtotal(itemElement) {
                const price = parseInt(itemElement.dataset.price);
                const quantity = parseInt(itemElement.querySelector('.quantity').value);
                const subtotal = price * quantity;
                const subtotalElement = itemElement.querySelector('.subtotal');

                // Add loading animation
                subtotalElement.classList.add('quantity-loading');

                setTimeout(() => {
                    subtotalElement.textContent = `Subtotal: ${formatIDR(subtotal)}`;
                    subtotalElement.classList.remove('quantity-loading');
                    subtotalElement.classList.add('animate-pulse');
                    setTimeout(() => subtotalElement.classList.remove('animate-pulse'), 500);
                }, 300);
            }

            // Enhanced button state management
            function checkSelectedItems() {
                const checkboxes = document.querySelectorAll('.item-checkbox');
                const checkedBoxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
                const isAnyChecked = checkedBoxes.length > 0;

                // Update button states with animations
                paymentButton.disabled = !isAnyChecked;
                selectedButton.disabled = !isAnyChecked;

                if (isAnyChecked) {
                    paymentButton.classList.remove('opacity-60', 'cursor-not-allowed');
                    selectedButton.classList.remove('opacity-60', 'cursor-not-allowed');
                    paymentButton.classList.add('hover:scale-105', 'hover:shadow-xl');
                    selectedButton.classList.add('hover:scale-105', 'hover:shadow-xl');
                } else {
                    paymentButton.classList.add('opacity-60', 'cursor-not-allowed');
                    selectedButton.classList.add('opacity-60', 'cursor-not-allowed');
                    paymentButton.classList.remove('hover:scale-105', 'hover:shadow-xl');
                    selectedButton.classList.remove('hover:scale-105', 'hover:shadow-xl');
                }

                // Update selected items text with animation
                const selectedText = document.getElementById('totalSelectedItems');
                if (checkedBoxes.length > 0) {
                    selectedText.textContent = `(${checkedBoxes.length} items)`;
                    selectedText.classList.add('animate-bounce');
                    setTimeout(() => selectedText.classList.remove('animate-bounce'), 500);
                } else {
                    selectedText.textContent = '';
                }
            }

            // Enhanced totals calculation with smooth animations
            function updateTotals() {
                const items = document.querySelectorAll('[data-price]');
                let totalItems = 0;
                let totalPrice = 0;

                items.forEach(item => {
                    if (item.querySelector('.item-checkbox').checked) {
                        const quantity = parseInt(item.querySelector('.quantity').value);
                        const price = parseInt(item.dataset.price);
                        totalItems += quantity;
                        totalPrice += price * quantity;
                    }
                });

                // Animate total updates
                const totalItemsElement = document.getElementById('totalItems');
                const totalPriceElement = document.getElementById('totalPrice');

                totalItemsElement.style.transform = 'scale(1.1)';
                totalPriceElement.style.transform = 'scale(1.1)';

                setTimeout(() => {
                    totalItemsElement.textContent = totalItems === 0 ? '0 items' : `${totalItems} items`;
                    totalPriceElement.textContent = formatIDR(totalPrice);

                    totalItemsElement.style.transform = 'scale(1)';
                    totalPriceElement.style.transform = 'scale(1)';
                }, 150);

                checkSelectedItems();
            }

            // Enhanced quantity input handlers with better UX
            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('input', function() {
                    let value = parseInt(this.value) || 1;
                    const min = parseInt(this.getAttribute('min') || 1);
                    const max = parseInt(this.getAttribute('max') || 999);

                    if (value < min) value = min;
                    if (value > max) value = max;

                    this.value = value;

                    const item = this.closest('[data-price]');
                    updateSubtotal(item);

                    if (item.querySelector('.item-checkbox').checked) {
                        updateTotals();
                    }
                });

                input.addEventListener('blur', function() {
                    let value = parseInt(this.value) || 1;
                    const min = parseInt(this.getAttribute('min') || 1);

                    if (value < min) {
                        this.value = min;
                        const item = this.closest('[data-price]');
                        updateSubtotal(item);

                        if (item.querySelector('.item-checkbox').checked) {
                            updateTotals();
                        }
                    }
                });

                input.addEventListener('keypress', function(e) {
                    const charCode = e.which ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });

            // Enhanced increment/decrement with visual feedback
            document.querySelectorAll('.increment').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('[data-price]');
                    const quantityElement = item.querySelector('.quantity');
                    const currentQuantity = parseInt(quantityElement.value);
                    const maxQuantity = parseInt(quantityElement.getAttribute('max') || 999);

                    if (currentQuantity < maxQuantity) {
                        this.classList.add('animate-pulse');
                        setTimeout(() => this.classList.remove('animate-pulse'), 300);

                        quantityElement.value = currentQuantity + 1;
                        updateSubtotal(item);

                        if (item.querySelector('.item-checkbox').checked) {
                            updateTotals();
                        }
                    }
                });
            });

            document.querySelectorAll('.decrement').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('[data-price]');
                    const quantityElement = item.querySelector('.quantity');
                    const currentQuantity = parseInt(quantityElement.value);
                    const minQuantity = parseInt(quantityElement.getAttribute('min') || 1);

                    if (currentQuantity > minQuantity) {
                        this.classList.add('animate-pulse');
                        setTimeout(() => this.classList.remove('animate-pulse'), 300);

                        quantityElement.value = currentQuantity - 1;
                        updateSubtotal(item);

                        if (item.querySelector('.item-checkbox').checked) {
                            updateTotals();
                        }
                    }
                });
            });

            // Enhanced checkbox interaction with visual feedback
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const item = this.closest('[data-price]');

                    if (this.checked) {
                        item.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50');
                        item.style.transform = 'scale(1.02)';
                    } else {
                        item.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50');
                        item.style.transform = 'scale(1)';
                    }

                    setTimeout(() => {
                        item.style.transform = 'scale(1)';
                    }, 200);

                    updateTotals();
                });
            });

            // Initialize totals
            updateTotals();

            // Add scroll animations for cart items
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe cart items for scroll animations
            document.querySelectorAll('[data-price]').forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = `all 0.6s ease ${index * 0.1}s`;
                observer.observe(el);
            });
        });
    </script>
@endpush
