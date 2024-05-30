<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderMinuman extends Model
{
    use HasFactory;
    protected $table = 'order_minuman';
    protected $fillable = [
        'order_id',
        'menu_minuman_id',
        'quantity',
        'unit_items',
        'total_harga_items',
    ];
    public function menuMinuman()
    {
        return $this->belongsTo(MenuMinuman::class, 'menu_minuman_id');
    }
}
