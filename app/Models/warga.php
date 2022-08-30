<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Warga extends Model
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_ktp',
        'nama_lengkap',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'golongan_darah',
        'warga_negara',
        'pendidikan',
        'pekerjaan',
        'status_nikah',
        'status_warga',
        'created_at',
        'updated_at'
    ];
}
