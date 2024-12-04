@extends('templates.app')

@section('container-content')
    <div class="my-2.5 mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="bg-white shadow-md rounded-lg max-w-3xl mx-auto p-5">
            <h1 class="text-2xl font-semibold mb-6 text-center text-gray-700">Create Karyawan!</h1>
            <form action="{{ route('karyawan.add_karyawan_page') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                {{-- @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-4 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="grid grid-cols-1 gap-6">
                    <!-- Gambar pratinjau -->
                    <div class="flex justify-center">
                        <img id="image-preview" class="h-96 object-cover mb-4 border-2 border-gray-200" alt="Image Preview"
                            src="https://placehold.co/200x200" />
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label for="name" class="text-gray-700 font-medium">Name :</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama karyawan" class="font-sans form-control">
                            @error('name')
                                <small class="font-sans text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="jabatan" class="text-gray-700 font-medium">Role :</label>
                            <select name="jabatan" id="jabatan" class="font-sans form-control">
                                <option value="" selected hidden disabled>Pilih Role</option>
                                <option value="Admin" {{ old('jabatan') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Kasir" {{ old('jabatan') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                            </select>
                            @error('jabatan')
                                <small class="font-sans text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="jenis_kelamin" class="text-gray-700 font-medium">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="font-sans form-control">
                                <option value="" selected hidden disabled>Pilih Jenis Kelamin</option>
                                <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <small class="font-sans text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="image" class="text-gray-700 font-medium">Choose Image :</label>
                            <input type="file" id="image" name="image" class="font-sans form-control"
                                onchange="previewImage(event)">
                            @error('image')
                                <small class="font-sans text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('karyawan.karyawan_page') }}"
                        class="text-blue-500 border-1 rounded-md px-4 py-2 border-blue-800 hover:text-blue-700 hover:bg-gray-100">Back</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
