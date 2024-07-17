<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'datetime:d M Y'
    ];

    public function getDataPengajuan()
    {
        $dataPengajuan = PengajuanSurat::select('wargas.nama_lengkap', 'pengajuan_surat.*')->join('wargas', 'wargas.warga_id', '=', 'pengajuan_surat.id')->get();
        return $dataPengajuan;
    }
}
