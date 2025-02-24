<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Create (Menyimpan data baru)
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'nullable|string',
        ]);

        $Product = Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
        ]);

        return response()->json(['message' => 'Product created successfully', 'data' => $Product]);
    }

    // Read (Mengambil data)
    public function read(Request $request)
    {
        $Products = Product::all();
        return response()->json($Products);
    }

    // Update (Mengupdate data berdasarkan ID)
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:Products,id',
            'name' => 'required|string|max:255',
            'stock' => 'required',
        ]);

        $Product = Product::findOrFail($request->id);
        $Product->update([
            'name' => $request->name,
            'stock' => $request->stock,
        ]);

        return response()->json(['message' => 'Product updated successfully', 'data' => $Product]);
    }

    // Delete (Menghapus data berdasarkan ID)
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:Products,id',
        ]);

        $Product = Product::findOrFail($request->id);
        $Product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
