<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderMakanan extends Model
{
    use HasFactory;
    protected $table = 'order_makanan';
    protected $fillable = [
        'order_id',
        'menu_makanan_id',
        'quantity',
        'unit_items',
        'total_harga_items',

    ];
    public function menuMakanan()
    {
        return $this->belongsTo(MenuMakanan::class, 'menu_makanan_id');
    }
}
