<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuMakanan extends Model
{
    use HasFactory;
    protected $table = 'menu_makanan';
    protected $fillable = [
        'nama_makanan',
        'image',
        'harga',

    ];

    // public function order(): BelongsToMany
    // {
    //     return $this->belongsToMany(MenuMakanan::class, 'pivot_makanan', 'order_id', 'menu_makanan_id');
    // }
}
