@extends('templates.admin')

@section('content')
    <!-- Header -->
    <header class="flex flex-col items-start justify-between mb-6 md:flex-row md:items-center md:mb-10">
        <div class="mb-4 md:mb-0">
            <h2 class="mb-2 text-2xl font-bold text-gray-800 md:text-4xl">
                Products
            </h2>
            <p class="text-sm text-gray-500 md:text-base">
                Manage your products here.
            </p>
        </div>
        <a href="{{ route('product.add_product') }}"
            class="flex items-center px-4 py-2 text-white transition-colors bg-indigo-600 rounded-lg shadow-lg md:px-6 md:py-3 hover:bg-indigo-700">
            <i class="mr-2 fas fa-plus"></i> Add New Product
        </a>
    </header>

    <!-- Product List -->
    <section class="p-4 overflow-x-auto bg-white shadow-sm rounded-xl md:p-6">
        @if (Session::get('success'))
            <div id="success-alert" class="relative p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500 animate-slideIn"
                role="alert">
                <p>{{ Session::get('success') }}</p>
                <button type="button" class="absolute text-2xl text-green-700 top-2 right-4 hover:text-green-900"
                    onclick="closeAlert()">&times;</button>
            </div>
        @endif

        @if ($product->isEmpty())
            <div class="py-6 text-center text-gray-500">
                <p>No products found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6">
                @foreach ($product as $index => $item)
                    <div class="p-4 transition-all bg-white shadow-md rounded-xl hover:shadow-lg">
                        <img alt="Product Image" src="{{ asset($item->image) }}"
                            class="md:w-full md:h-48 w-1/2 mx-auto my-2.5 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                            onclick="openImageModal('{{ asset($item->image) }}')" />

                        <!-- Image Modal -->
                        <div id="imageModal"
                            class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-75">
                            <div class="relative max-w-4xl mx-auto">
                                <button onclick="closeImageModal()"
                                    class="absolute text-2xl text-white top-4 right-4 hover:text-gray-300">
                                    <i class="fas fa-times"></i>
                                </button>
                                <img id="modalImage" src="" alt="Full size image"
                                    class="max-h-[90vh] max-w-[90vw] object-contain" />
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="mb-2 text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                            <div class="space-y-2 text-sm">
                                <p class="font-bold text-indigo-600">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                                <div class="flex justify-between text-gray-600">
                                    <span>Stock: {{ $item->stock }}</span>
                                    <span>Sold: {{ $totalSold[$item->id] ?? 0 }}</span>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4 space-x-3">
                                <a href="{{ route('product.edit_product', $item->id) }}"
                                    class="p-2 text-indigo-600 transition-colors rounded-full hover:bg-indigo-50">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-id="{{ $item->id }}"
                                    class="p-2 text-red-600 transition-colors rounded-full btn-delete hover:bg-red-50">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @foreach ($product as $item)
                <form id="delete-form-{{ $item->id }}" action="{{ route('product.hapus_product', $item->id) }}"
                    method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        @endif

        <!-- Pagination -->
        <div class="mt-6">
            {{ $product->links() }}
        </div>
    </section>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    Swal.fire({
                        title: "Apa anda yakin?",
                        text: "Untuk menghapus produk ini.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal",
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
        });

        function openImageModal(imageSrc) {
            // Get the modal and modal image elements
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            // Set the image source
            modalImage.src = imageSrc;

            // Show the modal by removing hidden class
            modal.classList.remove('hidden');

            // Prevent page scrolling when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            // Get the modal element
            const modal = document.getElementById('imageModal');

            // Hide the modal by adding hidden class
            modal.classList.add('hidden');

            // Restore page scrolling
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeImageModal();
            }
        });

        function closeAlert() {
            $('#success-alert').fadeOut(500, function() {
                $(this).remove();
            });
        }

        $(document).ready(function() {
            if ($('#success-alert').length) {
                setTimeout(function() {
                    closeAlert();
                }, 5000);
            }
        });

        // Mobile sidebar toggle
        const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
        const mobileSidebarClose = document.getElementById(
            "mobile-sidebar-close"
        );
        const mobileSidebar = document.getElementById("mobile-sidebar");

        // Open sidebar with animation (unclose)
        mobileMenuToggle.addEventListener("click", () => {
            mobileSidebar.classList.remove("hidden"); // Tampilkan sidebar
            setTimeout(() => {
                mobileSidebar.classList.remove("-translate-x-full");
                mobileSidebar.classList.add("translate-x-0"); // Tambahkan animasi masuk
            }, 10); // Tambahkan sedikit delay agar animasi terlihat
        });

        // Close sidebar with animation
        mobileSidebarClose.addEventListener("click", () => {
            mobileSidebar.classList.remove("translate-x-0");
            mobileSidebar.classList.add("-translate-x-full"); // Tambahkan animasi keluar
            setTimeout(() => {
                mobileSidebar.classList.add("hidden"); // Sembunyikan setelah animasi selesai
            }, 300); // Sesuaikan dengan `duration-300`
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener("click", (event) => {
            if (
                !mobileSidebar.contains(event.target) &&
                !mobileMenuToggle.contains(event.target) &&
                !mobileSidebarClose.contains(event.target)
            ) {
                mobileSidebar.classList.remove("translate-x-0");
                mobileSidebar.classList.add("-translate-x-full"); // Tambahkan animasi keluar
                setTimeout(() => {
                    mobileSidebar.classList.add("hidden"); // Sembunyikan setelah animasi selesai
                }, 300); // Sesuaikan dengan `duration-300`
            }
        });
    </script>
@endpush

@push('style')
    <style>
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

        .animate-slideIn {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
@endpush
