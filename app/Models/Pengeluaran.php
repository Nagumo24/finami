<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluarans'; // Sesuaikan dengan nama tabel di database kamu

    protected $fillable = [
        'tanggal',
        'jumlah',
        'keperluan', // <-- Pastikan ini tulisannya 'keperluan', bukan 'keterangan'
    ];
}
