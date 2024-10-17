@extends('templates.app')

@section('container-content')
    <div class="container-fi bg-white mt-2.5 rounded mx-auto p-16">
        @if (Session::get('success'))
            <div class="alert mt-2 alert-success flex justify-between">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="flex justify-between">
            <div class="text-xl font-bold text-gray-700 bg-gray-100 p-3">Data Karyawan</div>
            <a href="{{ route('karyawan.add_karyawan') }}" class="bg-blue-600 text-white rounded p-3 mb-2">
                Tambah Karyawan
            </a>
        </div>

        @if ($karyawan->isEmpty())
                <p class="text-center p-40 text-xl text-gray-500">Tidak ada data karyawan.</p>
            @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
            <!-- Card 1 -->
            @foreach ($karyawan as $index => $item)
                <div class="bg-gray-100 shadow-md rounded-lg">
                    <img class="m-auto w-52 p-1 border-2 border-gray-200 h-52 object-cover my-3 rounded" src="{{ asset($item->image) }}"
                        alt="Foto Karyawan">
                    <div class="p-4">
                        <p class="text-gray-600">Nama : <b class="text-black">{{ $item->name }}</b></p>
                        <p class="text-gray-600">Gender : <b class="text-black">{{ $item->jenis_kelamin }}</b></p>
                        <p class="text-gray-600">Posisi : <b class="text-black">{{ $item->jabatan }}</b></p>
                        <div class="flex justify-between mt-2 gap-2">
                            <a href="{{ route('karyawan.edit_karyawan_page', $item['id']) }}"
                                class="w-1/2 bg-gray-200 text-gray-700 py-2 text-center rounded font-bold hover:bg-gray-300">Edit</a>
                            <button 
                                class="w-1/2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                onclick="showModalDelete('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                        </div>
                    </div>
                </div>
            @endforeach
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
                            id="nama_karyawan">?</b>?
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
            // memasukkan teks dari parameter ke html bagian id = 'nama_karyawan'
            $('#nama_karyawan').text(name);
            // memanggil route hapus
            let url = "{{ route('karyawan.delete_karyawan', ':id') }}";
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
{{-- https://placehold.co/200x200 --}}
