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
        return view('order.kasir.product_page', compact('product'), [
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

        // Hitung total
        $validatedData['total'] = $request->price * $request->kty;

        $product = Product::where('id', $request->product_id)->first();
        if ($product->stock < $request->kty) {
            return redirect()->back()->with('success', 'Stok tidak mencukupi!');
        }

        $product->stock -= $request->kty;
        $product->save(); // Simpan perubahan stok ke database

        // Set user_id
        $validatedData['user_id'] = auth()->id();

        // Simpan data ke database
        Payment::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pembelian berhasil ditambahkan ke keranjang kamu!.');
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
        Payment::findOrFail($id)->delete();

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
