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
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-10">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">
                Dashboard
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                Welcome back! Here's an overview of your thrift store.
            </p>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-10">
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 hover:shadow-md transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xs md:text-sm font-medium text-gray-500 mb-2">
                        Total Products
                    </h3>
                    <p class="text-2xl md:text-4xl font-bold text-indigo-600">
                        {{ $product->count() }}
                    </p>
                </div>
                <i class="fas fa-box text-xl md:text-3xl text-indigo-300"></i>
            </div>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xs md:text-sm font-medium text-gray-500 mb-2">
                        Total Orders
                    </h3>
                    <p class="text-2xl md:text-4xl font-bold text-green-600">{{ $pesanan->count() }}</p>
                </div>
                <i class="fas fa-shopping-basket text-xl md:text-3xl text-green-300"></i>
            </div>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xs md:text-sm font-medium text-gray-500 mb-2">
                        Total Revenue
                    </h3>
                    <p class="text-2xl md:text-4xl font-bold text-purple-600">
                        @php
                            $totalRevenue = $pesanan->sum('total_price');
                            if ($totalRevenue >= 1000000) {
                                $formatted = 'Rp ' . number_format($totalRevenue / 1000000, 1) . 'M';
                            } else {
                                $formatted = 'Rp ' . number_format($totalRevenue, 0, '.', '.');
                            }
                        @endphp
                        {{ $formatted }}
                    </p>
                </div>
                <i class="fas fa-dollar-sign text-xl md:text-3xl text-purple-300"></i>
            </div>
        </div>
    </section>

    <!-- Recent Orders -->
    <section class="bg-white rounded-xl shadow-md p-4 md:p-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-4 md:mb-6">
            <h3 class="text-lg md:text-xl font-semibold text-gray-800">
                Recent Orders
            </h3>
            {{-- <a href="#" class="text-indigo-600 hover:text-indigo-800 transition-colors text-sm">View All</a> --}}
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-3 text-left">No</th>
                        <th class="py-3 text-left">Customer</th>
                        <th class="py-3 text-left">Total</th>
                        <th class="py-3 text-left">Status</th>
                        <th class="py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan as $order)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="py-4">{{ $loop->iteration }}</td>
                            <td class="py-4">{{ $order->user->name }}</td>
                            <td class="py-4 font-medium">Rp {{ number_format($order->total_price, 0, '.', '.') }}</td>
                            <td class="py-4">
                                <span
                                    class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs md:text-sm">Complete</span>
                            </td>
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.detail_payment', $order->id) }}"
                                    class="text-gray-500 hover:text-indigo-600 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="text-gray-500 hover:text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6 flex items-center justify-end">
                <div class="gap-4">{{ $pesanan->links('vendor.pagination.tailwind') }}</div>
            </div>
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
