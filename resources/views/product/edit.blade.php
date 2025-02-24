@extends('templates.admin')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Main Content -->
    <main class="flex-1 bg-gray-50 p-4 md:p-10 overflow-x-auto">
        <!-- Header -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-10">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">Edit Produk</h2>
                <p class="text-gray-500 text-sm md:text-base">Update Informasi Produk anda.</p>
            </div>
            <a href="{{ route('product.product_page') }}"
                class="bg-gray-600 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-gray-700 transition-colors shadow-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Produk
            </a>
        </header>

        <!-- Form Section -->
        <section class="bg-white rounded-xl shadow-md p-4 md:p-6">
            <form method="POST" action="{{ route('product.edit_product_proses', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image Preview -->
                    <div class="flex justify-center items-center">
                        <img id="image-preview" 
                             alt="Product Image" 
                             src="{{ $product->image ? asset($product->image) : 'https://placehold.co/300x200' }}"
                             class="rounded-lg shadow-md w-full max-w-xs" />
                    </div>

                    <!-- Form Inputs -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   placeholder="Enter product name"
                                   value="{{ $product->name }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price (Rp.)</label>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   placeholder="Enter price"
                                   value="{{ $product->price }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   placeholder="Enter stock"
                                   value="{{ $product->stock }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Choose Image</label>
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   onchange="previewImage(event)"
                                   class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-6 flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-indigo-700 transition-colors shadow-lg flex items-center">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>
    </main>
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