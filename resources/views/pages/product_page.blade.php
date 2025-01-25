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
                <a href="{{ route('product.add_product') }}"
                    class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Produk
                </a>
            </div>
        </div>
        <div class="mx-auto my-3">
            @if ($product->isEmpty())
                <div class="p-40 text-xl text-center text-gray-500">Tidak ada produk.</div>
            @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
                    @foreach ($product as $index => $item)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <img alt="Product Image" class="w-full h-56 object-cover mb-4"
                                src="{{ asset($item->image) }}" />
                            <p>Nama : <b>{{ $item['name'] }}</b></p>
                            <p>Harga : <b>Rp. {{ number_format($item['price'], 0, ',', '.') }}</b></p>
                            <p>Stock yang tersisa : <b>{{ $item['stock'] }}</b></p>
                            <div class="flex justify-between mt-2 gap-2">
                                <a href="{{ route('product.edit_product', $item['id']) }}"
                                    class="w-1/2 bg-gray-200 text-gray-700 py-2 text-center rounded font-bold hover:bg-gray-300">Edit</a>
                                <button
                                    class="w-1/2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                    onclick="showModalDelete('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
        <div class="d-flex justify-content-end my-3">
            {{ $product->links() }}
        </div>
    </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="modal-content" method="POST" action="">
                        {{-- action kosong, diisi melalui js karena id dikirim ke js nya  --}}
                        @csrf
                        {{-- menimpa method="post" jadi delete sesuai web.php http method --}}
                        @method('DELETE')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Hapus data product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="font-medium modal-body">
                            {{-- konten dinamis pada teks ini bagian nama obat, sehingga nama obatnya disediakan tempat penyimpanan (tag b) --}}
                            <span class="font-thin font-serif">Apakah anda yakin ingin menghapus Product</span> <b
                                id="nama_product">?</b>?
                        </div>
                        <div class="font-medium modal-footer">
                            <button type="button" class="w-1/4 bg-gray-200 text-gray-700 py-2 rounded"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="w-1/4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 py-2">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModalDelete(id, name) {
            // memasukkan teks dari parameter ke html bagian id = 'nama_product'
            $('#nama_product').text(name);
            // memanggil route hapus
            let url = "{{ route('product.hapus_product', ':id') }}";
            // isi path dinamis : id dari data parameter id
            url = url.replace(':id', id);
            // action="" di form diisi dengan url diatas
            $('form').attr('action', url);
            // memunculkan modal dengan id='exampleModal'
            $('#exampleModal').modal('show');
        }

        // Tambahkan script untuk alert auto-close
        $(document).ready(function() {
            // Otomatis close alert setelah 5 detik
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endpush
