<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $fillable = [
        'no_meja',
        'kapasitas',
        'status',
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
