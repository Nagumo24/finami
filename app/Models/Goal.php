<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $table = 'goals';

    protected $fillable = [
        'nama_target',
        'nominal_target',
        'nominal_terkumpul',
        'tenggat_waktu',
    ];
}
