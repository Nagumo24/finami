<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'tabungans'; // pastikan nama tabel sesuai database kamu

    protected $fillable = [
        'tanggal',
        'jumlah',
        'sumber',
        'keterangan'
    ];
}
