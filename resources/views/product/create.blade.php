@extends('templates.app')

@section('container-content')
    <div class="my-2.5 mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="bg-white shadow-md rounded-lg max-w-3xl mx-auto p-5">
            <h1 class="text-2xl font-semibold mb-6 text-center text-gray-700">Create Product!</h1>
            <form action="{{ route('product.add_product_page') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-100 text-red-600 p-4 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6">
                    <!-- Gambar pratinjau -->
                    <div class="flex justify-center">
                        <img id="image-preview" class="h-96 object-cover mb-4 border-2 border-gray-200" alt="Image Preview" src="https://placehold.co/300x200" />
                    </div>

                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <label for="name" class="text-gray-700 font-medium">Name :</label>
                            <input type="text" name="name" id="name" placeholder="Masukkan nama product" value="{{ old('name') }}" class="form-control font-sans">
                        </div>

                        <div class="flex flex-col">
                            <label for="price" class="text-gray-700 font-medium">Price (Rp.) :</label>
                            <input type="number" name="price" id="price" placeholder="Masukkan harga" value="{{ old('price') }}" class="form-control font-sans">
                        </div>

                        <div class="flex flex-col">
                            <label for="image" class="text-gray-700 font-medium">Choose Image :</label>
                            <input type="file" id="image" name="image" class="form-control font-sans" onchange="previewImage(event)">
                        </div>

                        <div class="flex flex-col">
                            <label for="stock" class="text-gray-700 font-medium">Stock :</label>
                            <input type="number" name="stock" id="stock" placeholder="Masukkan stok" value="{{ old('stock') }}" class="form-control font-sans">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('product.product_page') }}" class="text-blue-500 border-1 rounded-md px-4 py-2 border-blue-800 hover:text-blue-700 hover:bg-gray-100">Back</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection