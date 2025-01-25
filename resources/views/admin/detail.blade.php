@extends('templates.app')

@section('container-content')
    <div class="container mx-auto p-4 bg-white">
        <h1 class="text-2xl font-sans mb-6 text-center">Detail Pembelian untuk <span class="font-bold">{{ $user->name }}</span></h1>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-center">Nama Produk</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Jumlah</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Harga</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Total</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($payments as $payment)
                        @foreach ($payment['products'] as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border border-gray-300 text-center">{{ $item['name'] }}</td>
                                <td class="px-4 py-2 border border-gray-300 text-center">{{ $item['kty'] }}</td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    Rp{{ number_format($item['total'], 0, ',', '.') }}</td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    {{ \Carbon\Carbon::parse($payment->created_at)->locale('id')->translatedFormat('l, d F Y H:i:s') }}
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada pembayaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-block px-6 py-2 bg-blue-500 text-white font-semibold rounded shadow hover:bg-blue-600 transition">
                Kembali ke Daftar Pengguna
            </a>
        </div>
    </div>
@endsection
