<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    private $no = 0;
    private $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = Order::with('user');

        if ($this->date) {
            $query->whereDate('created_at', $this->date);
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
            'Nama',
            'Pesanan',
            'Total Harga',
            'Tanggal Pesan',
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($order): array
    {   
        $this->no++;
        
        return [
            $this->no,
            $order->user->name,
            collect($order->products)->map(function ($product) {
                return $product['name'] . ' : ' . $product['kty'];
            })->implode(', '),
            collect($order->products)->sum('total'),
            Carbon::parse($order->created_at)->locale('id')->isoFormat('dddd, D MMMM Y - H:mm:ss'),
        ];
    }
}
