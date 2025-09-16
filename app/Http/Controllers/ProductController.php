<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSold = Order::all()
            ->flatMap(function ($order) {
                // Pastikan data adalah string sebelum json_decode
                if (!is_array($order->products)) {
                    $products = json_decode($order->products, true);
                } else {
                    $products = $order->products;
                }
                return collect($products);
            })
            ->groupBy('product_id') // Kelompokkan berdasarkan product_id, bukan payment_id
            ->map(function ($group) {
                return $group->sum('quantity'); // Hitung total kuantitas untuk setiap product_id
            });
        $product = Product::simplePaginate(9);
        return view('pages.product_page', compact('product', 'totalSold'), [
            'title' => 'Product List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create', [
            'title' => 'Create Product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:3072', // 3MB in kilobytes
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric' // tambahkan nullable jika stock tidak wajib
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Maksimal 100 karakter',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus angka',
            'stock.numeric' => 'Stok harus angka',
            'image.mimes' => 'Format gambar yang diperbolehkan hanya PNG, JPG, JPEG',
            'image.max' => 'Ukuran gambar maksimal 3MB'
        ]);

        // Cek apakah ada file yang diupload
        if ($request->hasFile('image')) {
            // Ambil file dari request
            $file = $request->file('image');

            // Buat nama file unik menggunakan waktu dan nama asli file
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan file ke folder public/images
            $file->move(public_path('images'), $filename);

            // Simpan data produk ke dalam database, termasuk path gambar
            Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'image' => 'images/' . $filename, // Simpan path gambar
            ]);
        }

        return redirect()->route('product.product_page')->with('success', 'Data berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'), [
            'title' => 'Edit Product'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg|max:3072', // 3MB in kilobytes
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Maksimal 100 karakter',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus angka',
            'stock.numeric' => 'Stok harus angka',
            'image.mimes' => 'Format gambar yang diperbolehkan hanya PNG, JPG, JPEG',
            'image.max' => 'Ukuran gambar maksimal 3MB'
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Cek apakah ada file gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            // Simpan path gambar baru
            $product->image = 'images/' . $filename;
        }

        // Update data lainnya
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // Simpan perubahan
        $product->save();

        return redirect()->route('product.product_page')->with('success', 'Produk berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data Product!');
    }
}
