<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_percentage',
        'start_date',
        'end_date',
        'status',
    ];

    // Relasi ke Produk (belongsTo)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
