<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = [
        'tanggal',
        'nama_sayur',
        'nama_pembeli',
        'kuantitas',
        'harga_jual',
        'penghasilan'
    ];
}