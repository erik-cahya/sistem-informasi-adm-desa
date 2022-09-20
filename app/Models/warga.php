<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        'baca_tulis',
        'golongan_darah',
        'warga_negara',
        'pendidikan',
        'pekerjaan',
        'status_nikah',
        'status_warga',
        'created_at',
        'updated_at'
    ];

    public function getFullData($id = null)
    {
        if ($id != null) {
            $dataAnggota = \DB::table('wargas')
            ->leftJoin('detail_keluargas','detail_keluargas.warga_id', '=', 'wargas.id')
            ->leftJoin('keluargas','keluargas.id', '=', 'detail_keluargas.keluarga_id')
            ->where('wargas.id',$id)
            ->select('wargas.*','keluargas.no_kk','keluargas.ekonomi','detail_keluargas.status_anggota')
            ->first();

            return $dataAnggota;
        }
            $dataAnggota = \DB::table('wargas')
                ->leftJoin('detail_keluargas','detail_keluargas.warga_id', '=', 'wargas.id')
                ->leftJoin('keluargas','keluargas.id', '=', 'detail_keluargas.keluarga_id')
                ->select('wargas.*','keluargas.no_kk','keluargas.ekonomi','detail_keluargas.status_anggota')
                ->get();

            return $dataAnggota;
    }
}
