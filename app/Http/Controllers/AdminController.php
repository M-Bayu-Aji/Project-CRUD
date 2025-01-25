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
    public function show(User $user)
    {
        // Mengambil data pembayaran berdasarkan pengguna
        $payments = $user->ordersPayment;

        return view('admin.detail', compact('user', 'payments'), [
            'title' => 'Detail Payment'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
