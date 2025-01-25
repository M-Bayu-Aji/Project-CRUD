<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data produk untuk ditampilkan di halaman
        $product = Product::simplePaginate(9);

        // Ambil data total pembelian dari Payment
        $pembelian = Payment::all();

        // Hitung total penjualan berdasarkan kolom `products` di tabel `orders`
        $totalSold = Order::all()
            ->flatMap(function ($order) {
                // Decode JSON products dan ubah menjadi array
                return collect($order->products);
            })
            ->groupBy('product_id')
            ->map(function ($group) {
                return $group->sum('kty');
            });

        return view('order.kasir.product_page', compact('product', 'pembelian', 'totalSold'), [
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
            'kty' => 'required|integer|min:0',
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
            return redirect()->route('payment.add_payment_page');
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
