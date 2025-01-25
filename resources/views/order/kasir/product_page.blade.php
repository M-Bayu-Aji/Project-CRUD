@extends('templates.app')

@section('container-content')
    <div class="container-first rounded p-16 bg-white">
        @if (Session::get('success'))
            <div class="alert mt-2 alert-success flex justify-between">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="tittle text-center font-bold text-3xl mb-10"><i class="ri-store-3-line"></i> Thrift.Store</h1>
        <div class="container-second">
            <div class="label flex justify-between items-center rounded-lg">
                <div class="text-xl font-bold text-gray-700 bg-gray-100 p-3">Daftar Produk</div>
            </div>
        </div>
        <div class="mx-auto my-3">
            @if ($product->isEmpty())
                <div class="p-40 text-xl text-center text-gray-500">Tidak ada produk.</div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
                @foreach ($product as $index => $item)
                    <a href="{{ route('payment.add_payment', $item['id']) }}">
                        <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                            <img alt="Product Image" class="w-full h-56 object-cover mb-4 rounded-t-lg"
                                src="{{ asset($item->image) }}" />
                            <div class="p-4">
                                <h2 class="text-xl font-bold mb-2">{{ $item['name'] }}</h2>
                                <p class="text-gray-700 mb-2"><b>Rp. {{ number_format($item['price'], 0, ',', '.') }}</b>
                                </p>
                                <p class="text-gray-700 mb-2"><b>Stock : {{ $item['stock'] }}</b>
                                </p>
                                <p class="text-gray-700 mb-2"><b>{{ $totalSold[$item->id] ?? 0 }} Terjual</b></p>
                                <div class="flex items-center mb-2">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end my-3">
        {{ $product->links() }}
    </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script></script>
@endpush
