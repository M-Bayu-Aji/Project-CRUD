@extends('templates.app')

@section('container-content')
    <div class="container mx-auto p-8 bg-white">
        <h1 class="text-3xl font-bold mb-6 text-center">Total Pesanan</h1>

        <!-- Tombol Export Excel dengan Dropdown -->
        <div class="relative flex justify-end mb-4">
            <div>
                <a href="#" id="exportButton"
                    class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400">
                    <i class="bi bi-file-earmark-excel mr-2"></i> Export Excel
                    <i class="bi bi-chevron-down ml-2"></i>
                </a>
                <div id="dropdownMenu"
                    class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow ring-1 ring-black ring-opacity-5 hidden">
                    <form action="{{ route('admin.export_order') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full p-3 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="bi bi-clipboard-data mr-2"></i> Export Seluruh Data
                        </button>
                    </form>
                    <button data-bs-toggle="modal" data-bs-target="#dateModal"
                        class="block w-full p-3 text-left text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                        <i class="bi bi-calendar-range mr-2"></i> Export Berdasarkan Tanggal
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabel Pesanan -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-800">
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-white tracking-wider">
                                No</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-white tracking-wider">
                                Nama</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-white tracking-wider">
                                Pesanan</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-white tracking-wider">
                                Total Harga</th>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-white tracking-wider">
                                Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pesanan as $index => $order)
                            @foreach ($order['products'] as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <span class="inline-flex items-center">
                                            {{ $item['name'] }} : {{ $item['kty'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <span class="font-medium">Rp.
                                            {{ number_format($item['total'], 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($pesanan->hasPages())
                <div class="px-6 py-4 bg-gray-50">
                    {!! $pesanan->links() !!}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
        <div class="modal-dialog font-sans">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">Export (.xlsx)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="exportForm" action="{{ route('admin.export_order') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exportDate" class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="exportDate" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="submitExportButton" class="btn btn-primary">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const dropdownMenu = document.getElementById('dropdownMenu');
        const exportButton = document.getElementById('exportButton');

        // Fungsi untuk toggle dropdown
        exportButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Menutup dropdown ketika klik di luar elemen dropdown
        document.addEventListener('click', (event) => {
            if (!dropdownMenu.contains(event.target) && !exportButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endsection
