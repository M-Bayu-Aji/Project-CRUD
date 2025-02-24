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
    public function index() {
        $pesanan = Order::all();
        return view('admin.orders', compact('pesanan'), [
            'title' => 'Orders'
        ]);
    }

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
    public function store(Request $request)
    {
        // Get selected products
        $selectedProducts = $request->input('selected_products', []);
        $quantities = $request->input('quantity', []);

        // Check if any products are selected
        if (empty($selectedProducts)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        // Get selected products from database
        $products = Payment::whereIn('id', $selectedProducts)->get();

        // Prepare order items array
        $orderItems = [];

        foreach ($products as $product) {
            $quantity = $quantities[$product->id] ?? 1;
            $orderItems[] = [
                'product_id' => $product->product_id, // Pastikan ini sesuai dengan kolom yang benar
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
                'image' => $product->image
            ];
        }

        $totalPrice = array_sum(array_column($orderItems, 'total'));
        
        $lastOrder = Order::latest()->first();
        $nextOrderNumber = $lastOrder ? intval(substr($lastOrder->order_id, 1)) + 1 : 1;
        $formattedOrderId = '#' . str_pad($nextOrderNumber, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'products' => json_encode($orderItems), // Store as JSON
            'name' => auth()->user()->name,
            'total_price' => $totalPrice,
            'image' => $product->image,
            'order_id' => $formattedOrderId
        ]);

        // Update product stock using selected products
        foreach ($orderItems as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) continue;
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Delete selected items from Payment table
        Payment::whereIn('id', $selectedProducts)->delete();

        // Redirect to order detail page
        return redirect()->route('order.order_page1', ['id' => $order->id])->with('success', 'Order successful');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $order = Order::find($id);
        $products = json_decode($order->products, true);
        return view('order.kasir.order', compact('order', 'products'));
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
