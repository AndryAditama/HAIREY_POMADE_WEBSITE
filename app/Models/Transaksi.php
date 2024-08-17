<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'kode_transaksi',
        'jumlah_barang',
        'total',
        'tanggal',
        'bukti_transfer',
        'status'
    ];
}
