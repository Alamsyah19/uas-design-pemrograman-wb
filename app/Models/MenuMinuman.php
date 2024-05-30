<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuMinuman extends Model
{
    use HasFactory;
    protected $table = 'menu_minuman';
    protected $fillable = [
        'nama_minuman',
        'image',
        'harga',
    ];
    // public function order(): BelongsToMany
    // {
    //     return $this->belongsToMany(MenuMinuman::class, 'pivot_minuman', 'order_id', 'menu_minuman_id');
    // }
}
