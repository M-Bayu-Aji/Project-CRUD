<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class   PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::simplePaginate(9);
        $pembelian = Payment::all();

        $productIds = $pembelian->pluck('product_id')->toArray();
        $arrayValues = array_count_values($productIds);
        return view('order.kasir.product_page', compact('product', 'arrayValues'), [
            'title' => 'Payment Page'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input (tanpa 'total')
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'kty' => 'required|integer|min:1',
        ]);

        // Set product_id
        $validatedData['product_id'] = $request->product_id;
        // Hitung total
        $validatedData['total'] = $request->price * $request->kty;

        // Cek stok produk
        $product = Product::where('id', $request->product_id)->first();
        if ($product->stock < $request->kty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $product->stock -= $request->kty;
        $product->save(); // Simpan perubahan stok ke database

        // Set user_id
        $validatedData['user_id'] = auth()->id();

        // Simpan data ke database
        Payment::create($validatedData);

        // Cek aksi berdasarkan input "action"
        if ($request->action === 'add_to_cart') {
            // Aksi untuk Masukkan Keranjang
            return redirect()->back()->with('success', 'Pembelian berhasil ditambahkan ke keranjang kamu!');
        } elseif ($request->action === 'buy_now') {
            // Aksi untuk Beli Sekarang
            return redirect()->route('payment.add_payment_page')->with('success', 'Pembelian berhasil!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {

        $products = Payment::all();
        return view('order.kasir.keranjang', compact('products'), ['title' => 'Add Payment']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data Payment berdasarkan ID
        $payment = Payment::findOrFail($id);

        // Cari produk terkait menggunakan product_id dari Payment
        $product = Product::find($payment->product_id);

        // Jika produk ditemukan, tambahkan stok berdasarkan nilai kty
        if ($product) {
            $product->stock += $payment->kty;
            $product->save();
        }

        // Hapus data Payment setelah stok diperbarui
        $payment->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil Menghapus Data Product!');
    }


    public function addPayment($id)
    {
        $product = Product::find($id);
        return view('order.kasir.create', compact('product'), [
            'title' => 'Add Payment'
        ]);
    }
}
