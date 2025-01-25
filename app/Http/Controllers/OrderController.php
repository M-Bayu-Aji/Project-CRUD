<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Ambil semua data dari Payment
        $orderItems = Payment::all();

        // Pastikan data tidak kosong
        if ($orderItems->isEmpty()) {
            return redirect()->back()->with('error', 'No payment data available to process.');
        }

        // Buat array produk menggunakan koleksi
        $products = $orderItems->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'name' => $item->name,
                'price' => $item->price,
                'kty' => $item->kty,
                'total' => $item->total
            ];
        })->toArray();

        // Buat data order baru
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'products' => $products, // Disimpan dalam format JSON
            'name' => auth()->user()->name
        ]);

        foreach ($orderItems as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->kty;
                $product->save();
            }
        }

        // Hapus semua data di tabel Payment setelah order berhasil dibuat
        Payment::truncate();

        // Redirect ke halaman order detail
        return redirect()->route('order.order_page1', ['id' => $order->id])->with('success', 'Order Berhasil');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $order = Order::find($id);
        return view('order.kasir.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function createPDF($id)
    {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        $order = Order::find($id)->toArray();
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial 
        view()->share('inisial', $order);
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('order.kasir.download', ['order' => $order]);
        // download PDF file dengan nama tertentu
        return $pdf->download('struk-pembelian.pdf');
    }
}
