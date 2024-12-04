@extends('templates.app')

@section('container-content')
    <div class="min-h-screen flex items-center justify-center bg-white">
        <div class="w-full max-w-xl bg-white shadow rounded-lg p-8">

            @if (Session::get('success'))
                <div class="alert font-sans mt-2 alert-success flex justify-between">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main>
                <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Please login</h1>
                <form action="/login" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm my-2 font-medium text-gray-700">Email address
                            :</label>
                        <input type="email" name="email" id="email" class="font-sans form-control"
                            placeholder="name@example.com" value="{{ old('email') }}">
                        @error('email')
                            <small class="font-sans text-red-500 text-sm mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm my-2 font-medium text-gray-700">Password :</label>   
                        <input type="password" name="password" id="password" class="font-sans form-control"
                            placeholder="Password">
                        @error('password')
                            <small class="font-sans d-block text-red-500 text-sm mt-1">
                                {{ $message }}
                            </small>
                        @enderror
                        <label for="showPassword" class="font-sans mt-3">
                            <input type="checkbox" id="showPassword" onclick="showPassword()">
                            Tampilkan Password
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-2 px-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-300">
                        Login
                    </button>
                </form>

                <small class="block text-center text-sm text-gray-500 mt-4">
                    Not registered? <a href="/register" class="text-blue-600 hover:underline">Register Now!</a>
                </small>
            </main>
        </div>
    </div>
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

            const passwordField = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("showPassword");

            showPasswordCheckbox.addEventListener("change", function() {
                if (this.checked) {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            });
        </script>
    @endpush
@endsection
