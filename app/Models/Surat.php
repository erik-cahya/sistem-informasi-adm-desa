<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_surat',
        'no_surat',
        'nama_surat',
        'tanggal_surat'
    ];

    protected $casts = [
        'tanggal_surat' => 'datetime:d M Y'
    ];
}
