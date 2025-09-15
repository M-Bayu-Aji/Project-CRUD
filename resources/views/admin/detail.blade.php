@extends('templates.admin')

@push('style')
    <style>
        @media (max-width: 640px) {
            .mobile-collapse {
                flex-direction: column;
                align-items: stretch;
            }

            .mobile-full-width {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-10">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">
                Order Detail
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                Detailed information about the order.
            </p>
        </div>
        <button
            class="bg-indigo-600 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-indigo-700 transition-colors shadow-lg flex items-center">
            <i class="fas fa-print mr-2"></i> Print Invoice
        </button>
    </header>

    <!-- Order Information -->
    <section class="bg-white rounded-xl shadow-md p-4 md:p-6 mb-6 md:mb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Customer Information -->
            <div>
                <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">
                    Customer Information
                </h3>
                <div class="space-y-2">
                    <p class="text-gray-600"><strong>Name:</strong> {{ $payments['name'] }}</p>
                    <p class="text-gray-600">
                        <strong>Email:</strong> {{ $payments->user->email }}
                    </p>
                    <p class="text-gray-600">
                        <strong>Phone:</strong> +1 234 567 890
                    </p>
                    <p class="text-gray-600">
                        <strong>Address:</strong> 123 Main St, Anytown, USA
                    </p>
                </div>
            </div>

            <!-- Order Details -->
            <div>
                <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">
                    Order Details
                </h3>
                <div class="space-y-2">
                    @php
                        $displayedOrders = [];
                    @endphp

                    @foreach ($arrayOrder as $item)
                        @if (!in_array($payments['id'], $displayedOrders))
                            @php
                                $displayedOrders[] = $payments['id'];
                            @endphp

                            <p class="text-gray-600">
                                <strong>Order ID:</strong> {{ $payments['order_id'] }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Order Date:</strong>
                                {{ \Carbon\Carbon::parse($payments['created_at'])->format('F d, Y') }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Status:</strong>
                                <span
                                    class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs md:text-sm">Completed</span>
                            </p>
                            <p class="text-gray-600">
                                <strong>Total Amount:</strong> Rp
                                {{ number_format(array_sum(array_column($arrayOrder, 'total')), 0, '.', '.') }}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Order Items -->
    <section class="bg-white rounded-xl shadow-md p-4 md:p-6">
        <h3 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">
            Order Items
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-3 text-left">Product</th>
                        <th class="py-3 text-left">Quantity</th>
                        <th class="py-3 text-left">Price</th>
                        <th class="py-3 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrayOrder as $item)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td>
                                <div class="w-1/2 flex items-center">
                                    <img
                                      src="{{ asset($item['image']) }}"
                                      alt="Vintage Leather Jacket"
                                      class="w-12 h-12 object-cover rounded mr-4"
                                    />
                                    <span>{{ $item['name'] }}</span>
                                  </div>
                            </td>
                            <td class="py-4">{{ $item['quantity'] }}</td>
                            <td class="py-4">Rp {{ number_format($item['price'], 0, '.', '.') }}</td>
                            <td class="py-4">Rp {{ number_format($item['total'], 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('script')
    <script>
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
