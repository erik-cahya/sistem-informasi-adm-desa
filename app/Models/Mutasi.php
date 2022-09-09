<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mutasi extends Model
{
     use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'warga_id',
        'jenis_mutasi',
        'tgl_keluar_masuk',
        'keterangan'
    ];

    public function getFullData($id = null)
    {
        if ($id == null) {
            $dataMutasi = Mutasi::select('mutasis.*',
                'wargas.no_ktp','wargas.nama_lengkap'
            )->join('wargas','wargas.id','=','mutasis.warga_id')->get();

            return $dataMutasi;
        }

        $data = Mutasi::select('mutasis.*',
                'wargas.no_ktp','wargas.nama_lengkap'
            )->join('wargas','wargas.id','=','mutasis.warga_id')->get();

        return $data;
    }
}
