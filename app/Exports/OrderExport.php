<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    private int $no = 0;
    private ?string $date;

    public function __construct(?string $date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = Order::with('user');

        if ($this->date) {
            $query->whereDate('created_at', Carbon::parse($this->date));
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Order ID',
            'Nama',
            'Pesanan',
            'Total Harga',
            'Tanggal Pesan',
        ];
    }

    /**
     * @param Order $order
     * @return array
     */
    public function map($order): array
    {
        $this->no++;

        // Pastikan data adalah string sebelum json_decode
        if (!is_array($order->products)) {
            $products = json_decode($order->products, true) ?? [];
        } else {
            $products = $order->products ?? [];
        }
        $productDetails = collect($products)->map(function ($product) {
            return $product['name'] . ' : ' . ($product['qty'] ?? 0);
        })->implode(', ');

        $totalPrice = collect($products)->sum('total') ?? 0;

        return [
            $this->no,
            $order->order_id,
            $order->user->name ?? 'N/A',
            $productDetails,
            $totalPrice,
            Carbon::parse($order->created_at)->locale('id')->isoFormat('dddd, D MMMM Y - H:mm:ss'),
        ];
    }
}
