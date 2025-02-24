@extends('templates.admin')

@section('content')
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-10">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">
                Products
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                Manage your products here.
            </p>
        </div>
        <a href="{{ route('product.add_product') }}"
            class="bg-indigo-600 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-indigo-700 transition-colors shadow-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </header>

    <!-- Product List -->
    <section class="bg-white rounded-xl shadow-sm p-4 md:p-6 overflow-x-auto">
        @if (Session::get('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 relative"
                role="alert">
                <p>{{ Session::get('success') }}</p>
                <button type="button" class="text-2xl absolute top-2 right-4 text-green-700 hover:text-green-900"
                    onclick="closeAlert()">&times;</button>
            </div>
        @endif

        @if ($product->isEmpty())
            <div class="text-center text-gray-500 py-6">
                <p>No products found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                @foreach ($product as $index => $item)
                    <div class="bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <img alt="Product Image" src="{{ asset($item->image) }}"
                            class="md:w-full md:h-48 w-1/2 mx-auto my-2.5 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                            onclick="openImageModal('{{ asset($item->image) }}')" />

                        <!-- Image Modal -->
                        <div id="imageModal"
                            class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center">
                            <div class="relative max-w-4xl mx-auto">
                                <button onclick="closeImageModal()"
                                    class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
                                    <i class="fas fa-times"></i>
                                </button>
                                <img id="modalImage" src="" alt="Full size image"
                                    class="max-h-[90vh] max-w-[90vw] object-contain" />
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $item->name }}</h3>
                            <div class="space-y-2 text-sm">
                                <p class="text-indigo-600 font-bold">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                                <div class="flex justify-between text-gray-600">
                                    <span>Stock: {{ $item->stock }}</span>
                                    <span>Sold: {{ $totalSold[$item->id] ?? 0 }}</span>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4 space-x-3">
                                <a href="{{ route('product.edit_product', $item->id) }}"
                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-full transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-id="{{ $item->id }}"
                                    class="btn-delete p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors">
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
