<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id','name', 'price', 'stock', 'image', 'total'];

    public function orders() {
        return $this->belongsTo(Payment::class);
    }
}
