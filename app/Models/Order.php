<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'meja_id',
        'tgl_order',
        'total_harga',
        'user_id',
    ];

    public function itemMakanan()
    {
        return $this->hasMany(orderMakanan::class);
    }
    public function itemMinuman()
    {
        return $this->hasMany(orderMinuman::class);
    }

    public function meja(): BelongsTo
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
