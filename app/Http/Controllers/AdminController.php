<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $karyawan = Karyawan::all();
        $pesanan = Order::all();
        $users = User::has('ordersPayment')->get();
        $totalSold = Order::all()
            ->flatMap(function ($order) {
                $products = json_decode($order->products, true);
                return collect($products);
            })
            ->groupBy('product_id') // Kelompokkan berdasarkan product_id, bukan payment_id
            ->map(function ($group) {
                return $group->sum('quantity'); // Hitung total kuantitas untuk setiap product_id
            });

        return view('admin.dashboard', compact('product', 'karyawan', 'pesanan', 'users'), [
            'title' => 'Admin Dashboard'
        ]);
    }

    public function totalPesanan()
    {
        $pesanan = Order::simplePaginate(10);
        return view('admin.total_pesanan', compact('pesanan'), [
            'title' => 'Total Pesanan'
        ]);
    }

    public function exportOrder(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
            $orders = Order::whereDate('created_at', $date)->get();
        } else {
            $orders = Order::get();
        }

        return Excel::download(new OrderExport($request->date), 'Data pesanan-' . ($request->date ?? 'seluruh') . '.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payments = Order::find($id);

        if (!$payments) {
            abort(404);
        }

        // Pastikan data adalah string sebelum json_decode
        if (!is_array($payments->products)) {
            $payments->products = json_decode($payments->products, true);
        }

        $arrayOrder = [];

        // Pastikan setelah json_decode, hasilnya adalah array
        if (is_array($payments->products)) {
            foreach ($payments->products as $product) {
                array_push($arrayOrder, [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'total' => $product['total'],
                    'image' => $product['image']
                ]);
            }
        } else {
            dd("Data tidak valid:", $payments->products);
        }


        $user = User::find($payments->user_id);
        return view('admin.detail', compact('payments', 'user', 'arrayOrder'), [
            'title' => 'Detail Payment'
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search'); // Ambil nilai search dari request

        // Lakukan pencarian berdasarkan username
        $users = User::where('username', 'like', '%' . $search . '%')
            ->with('ordersPayment') // Eager load relasi ordersPayment
            ->get();

        // Jika ingin menampilkan pesanan (orders) dari user yang ditemukan
        $pesanan = collect(); // Buat koleksi kosong untuk menyimpan pesanan
        foreach ($users as $user) {
            $pesanan = $pesanan->merge($user->ordersPayment); // Gabungkan pesanan dari setiap user
        }

        return view('admin.orders', [
            'pesanan' => $pesanan, // Kirim data pesanan ke view
            'title' => 'Orders',
            'search' => $search, // Kirim nilai search untuk ditampilkan di input
        ]);
    }
}
