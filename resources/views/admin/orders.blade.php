@extends('templates.admin')

@section('content')
    <div class="flex justify-between">
        <div class="flex justify-end mb-4">
            <a href="{{ route('order.export') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
        </div>
        <form method="GET" action="{{ route('admin.search') }}" class="mb-4">
            <div class="flex justify-end gap-2">
                <input type="text" name="search" placeholder="Search username" value="{{ request('search') }}"
                    class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    Search
                </button>
            </div>
        </form>
    </div>

    @if (Session::get('error'))
        <div class="alert mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-between items-center"
            role="alert">
            <span>{{ Session::get('error') }}</span>
            <button type="button" class="btn-close ml-4" data-bs-dismiss="alert" aria-label="Close">
                <span class="text-xl"></span>
            </button>
        </div>
    @endif

    <section class="bg-white rounded-xl shadow-md p-4 md:p-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-4 md:mb-6">
            <h3 class="text-lg md:text-xl font-semibold text-gray-800">
                Recent Orders
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-3 text-left">No</th>
                        <th class="py-3 text-left">Order ID</th>
                        <th class="py-3 text-left">Customer</th>
                        <th class="py-3 text-left">Total</th>
                        <th class="py-3 text-left">Status</th>
                        <th class="py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanan as $order)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="py-4">{{ $loop->iteration }}</td>
                            <td class="py-4">{{ $order->order_id }}</td>
                            <td class="py-4">{{ $order->user->name }}</td>
                            <td class="py-4 font-medium">Rp {{ number_format($order->total_price, 0, '.', '.') }}</td>
                            <td class="py-4">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs md:text-sm">
                                    Complete
                                </span>
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
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6 flex items-center justify-end">
                <div class="gap-4">{{ $pesanan->links('vendor.pagination.tailwind') }}</div>
            </div>
        </div>
        </div>
    </section>
@endsection
