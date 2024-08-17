<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLinePesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'customer_id',
        'status',
        'tanggal'
    ];
}
