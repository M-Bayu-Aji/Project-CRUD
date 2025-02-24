@extends('templates.app')

@section('container-content')
    <div class="container mx-auto px-4 pt-10 pb-72 bg-white">
        @if (Session::get('success'))
            <div class="alert mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-between items-center"
                role="alert">
                <span>{{ Session::get('success') }}</span>
                <button type="button" class="btn-close ml-4" data-bs-dismiss="alert" aria-label="Close">
                    <span class="text-xl"></span>
                </button>
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center min-h-[400px] py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-8 text-center">
                    <img class="mx-auto h-32 w-32 object-contain transition-transform duration-300 "
                        src="https://storage.googleapis.com/a1aa/image/BFKPsbDrBHKEFpT0bKk6s9MufODlk56DIIO8fkeBtr4UquRoA.jpg"
                        alt="Empty Shopping Cart" loading="lazy">
                    <div class="space-y-4">
                        <h1 class=" font-bold text-gray-900 sm:text-xl">
                            Keranjang Belanjamu Kosong
                        </h1>
                        <p class="text-gray-600 text-sm max-w-sm mx-auto">
                            Yuk, telusuri koleksi ThriftStore kami dan temukan barang impianmu!
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('payment.payment_page') }}"
                                class="inline-flex items-center justify-center px-4 py-3 border-1 border-blue-600 
                                      rounded-lg text-base font-medium text-blue-600 hover:text-white transition-all duration-200 
                                      shadow-sm hover:bg-blue-600 ">
                                <span>Mulai Belanja</span>
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <form action="{{ route('order.order_page2') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Cart Items Section -->
                    <div class="lg:col-span-8">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg shadow-sm p-4 md:p-6" data-price="{{ $product->price }}"
                                data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                <div
                                    class="flex flex-col sm:flex-row shadow-md p-3 items-start sm:items-center gap-4 border-b border-gray-200 pb-6   relative">
                                    <div class="flex items-center gap-4 p-2.5 w-full sm:w-auto">
                                        <input type="checkbox" class="item-checkbox w-5 h-5" name="selected_products[]"
                                            value="{{ $product->id }}">
                                        <div
                                            class="w-1/2 mx-auto sm:w-24 sm:h-24 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                    </div>

                                    <div class="flex-1 space-y-2">
                                        <div class="flex w-44">
                                            <h5 class="font-semibold text-gray-800 text-sm">{{ $product->name }}</h5>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-medium text-gray-600">
                                                Rp {{ number_format($product->price, 0, '.', '.') }}
                                            </span>
                                        </div>
                                        <div class="hidden sm:block">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Tersedia
                                            </span>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center gap-6 sm:gap-8 w-full sm:w-auto justify-between sm:justify-end">
                                        <div class="flex items-center gap-3 border rounded-lg p-1">
                                            <button type="button"
                                                class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 rounded decrement">
                                                <i class="fas fa-minus w-3 h-3"></i>
                                            </button>
                                            <input type="number" class="w-12 text-center font-medium quantity"
                                                name="quantity[{{ $product->id }}]" value="1" min="1"
                                                max="999">
                                            <button type="button"
                                                class="w-8 h-8 flex items-center justify-center hover:bg-gray-100 rounded increment">
                                                <i class="fas fa-plus w-3 h-3"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button type="button"
                                        class="btn-delete bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors flex items-center gap-2"
                                        data-id="{{ $product->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Section -->
                    <div class="lg:col-span-4">
                        <div class="bg-white rounded-lg shadow-sm p-6 lg:sticky lg:top-8">
                            <h2 class="text-xl font-bold mb-4">Ringkasan Belanja</h2>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Barang</span>
                                    <span id="totalItems">0 items</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Harga</span>
                                    <span class="font-medium" id="totalPrice">Rp 0</span>
                                </div>
                            </div>

                            <!-- Tombol Hapus yang Dipilih -->
                            <button type="button" id="deleteSelectedItems"
                                class="w-full bg-red-500 text-white py-3 rounded-lg font-medium hover:bg-red-600 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 mb-4">
                                Hapus <span id="totalSelectedItems"></span>
                            </button>

                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                id="checkout" disabled>
                                Lanjut ke Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            @foreach ($products as $product)
                <form id="delete-form-{{ $product->id }}" action="{{ route('payment.delete_payment', $product->id) }}"
                    method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            <form id="deleteSelectedForm" action="{{ route('payment.delete_selected') }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
                <input type="hidden" name="selected_items" id="selectedItemsInput">
            </form>
        @endif
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                        customClass: {
                            title: 'font-sans',
                            content: 'font-sans',
                            confirmButton: 'font-sans',
                            cancelButton: 'font-sans'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success",
                                customClass: {
                                    title: 'font-sans',
                                    content: 'font-sans',
                                    confirmButton: 'font-sans'
                                }
                            });
                            // Add 2 second delay before form submission
                            setTimeout(() => {
                                document.getElementById(`delete-form-${id}`)
                                    .submit();
                            }, 500);
                        }
                    });
                });
            });

            // Fungsi untuk menghapus item yang dipilih
            document.getElementById('deleteSelectedItems').addEventListener('click', function() {
                const selectedItems = document.querySelectorAll('.item-checkbox:checked');
                if (selectedItems.length === 0) {
                    Swal.fire({
                        title: "Tidak ada item yang dipilih",
                        text: "Silakan pilih item yang ingin dihapus.",
                        icon: "warning",
                        customClass: {
                            title: 'font-sans',
                            content: 'font-sans',
                            confirmButton: 'font-sans'
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Item yang dipilih akan dihapus dari keranjang.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    customClass: {
                        title: 'font-sans',
                        content: 'font-sans',
                        confirmButton: 'font-sans',
                        cancelButton: 'font-sans'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kumpulkan ID item yang dipilih
                        const selectedIds = [];
                        selectedItems.forEach(checkbox => {
                            const itemId = checkbox.value;
                            selectedIds.push(itemId);
                        });
                        document.getElementById('selectedItemsInput').value = selectedIds.join(',');
                        document.getElementById('deleteSelectedForm').submit();

                        // Hapus item dari DOM setelah form di-submit
                        selectedItems.forEach(checkbox => {
                            const item = checkbox.closest('[data-price]');
                            item.remove();
                        });

                        updateTotals();

                        Swal.fire({
                            title: "Dihapus!",
                            text: "Item yang dipilih telah dihapus.",
                            icon: "success",
                            customClass: {
                                title: 'font-sans',
                                content: 'font-sans',
                                confirmButton: 'font-sans'
                            }
                        });
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const paymentButton = document.querySelector('#checkout');
            const selectedButton = document.querySelector('#deleteSelectedItems');

            function formatIDR(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(number);
            }

            // Update subtotal for an item
            function updateSubtotal(itemElement) {
                const price = parseInt(itemElement.dataset.price);
                const quantity = parseInt(itemElement.querySelector('.quantity').value);
                const subtotal = price * quantity;
                itemElement.querySelector('.subtotal').textContent = formatIDR(subtotal);
            }

            function checkSelectedItems() {
                const checkboxes = document.querySelectorAll('.item-checkbox');
                const isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

                paymentButton.disabled = !isAnyChecked;
                selectedButton.disabled = !isAnyChecked;
                if (isAnyChecked) {
                    paymentButton.classList.remove('bg-gray-400');
                    selectedButton.classList.remove('bg-gray-400');
                    paymentButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                    selectedButton.classList.add('bg-red-500', 'hover:bg-red-600');
                } else {
                    paymentButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    selectedButton.classList.remove('bg-red-500', 'hover:bg-red-600');
                    paymentButton.classList.add('bg-gray-400');
                    selectedButton.classList.add('bg-gray-400');
                }
            }

            // Update cart totals
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

                document.getElementById('totalItems').textContent = `${totalItems} items`;
                document.getElementById('totalSelectedItems').textContent = totalItems === 0 ? '' :
                    `${totalItems} items`;
                document.getElementById('totalPrice').textContent = formatIDR(totalPrice);
                checkSelectedItems();
            }

            // Add event listeners to quantity inputs
            document.querySelectorAll('.quantity').forEach(input => {
                // Update subtotal only when editing ends
                input.addEventListener('blur', function() {
                    const item = this.closest('[data-price]');
                    updateSubtotal(item);
                    updateTotals();
                });
            });

            // Add event listeners to increment buttons
            document.querySelectorAll('.increment').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('[data-price]');
                    const quantityElement = item.querySelector('.quantity');
                    const currentQuantity = parseInt(quantityElement.value);
                    quantityElement.value = currentQuantity + 1;
                    updateSubtotal(item);
                    updateTotals();
                });
            });

            // Add event listeners to decrement buttons
            document.querySelectorAll('.decrement').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('[data-price]');
                    const quantityElement = item.querySelector('.quantity');
                    const currentQuantity = parseInt(quantityElement.value);
                    if (currentQuantity > 1) {
                        quantityElement.value = currentQuantity - 1;
                        updateSubtotal(item);
                        updateTotals();
                    }
                });
            });

            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-item').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('[data-price]');
                    item.remove();
                    updateTotals();
                });
            });

            // Add event listeners to checkboxes
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTotals();
                });
            });

            // Initial update of totals
            updateTotals();
        });
    </script>
@endpush
