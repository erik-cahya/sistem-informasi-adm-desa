<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Keluarga extends Model
{
     use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_kk',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'ekonomi'
    ];

    public function getFullData($id = null)
    {
        if ($id == null) {
            $dataKeluarga = Keluarga::get();

            $data = [];
            foreach ($dataKeluarga as $key => $keluarga) {
                
                $dataAnggota = Warga::join('detail_keluargas','detail_keluargas.warga_id','=','wargas.id')
                        ->where(['detail_keluargas.keluarga_id' => $keluarga->id])
                        ->get();

                 $data[$key] = [
                        'id' => $keluarga->id,
                        'no_kk' => $keluarga->no_kk,
                        'alamat' => $keluarga->alamat,
                        'dusun' => $keluarga->dusun,
                        'rt' => $keluarga->rt,
                        'rw' => $keluarga->rw,
                        'ekonomi' => $keluarga->ekonomi,
                        'created_at' => $keluarga->created_at,
                        'updated_at' =>$keluarga->updated_at,
                        'anggota' => $dataAnggota
                    ];

            }

            return $data;
        }


        $dataKeluarga = Keluarga::find($id);

        if ($dataKeluarga == null) {
            return $dataKeluarga;
        }

        $dataAnggota = Warga::join('detail_keluargas','detail_keluargas.warga_id','=','wargas.id')
                        ->where(['detail_keluargas.keluarga_id' => $id])
                        ->get();

        $data = [
            'id' => $dataKeluarga->id,
            'no_kk' => $dataKeluarga->no_kk,
            'alamat' => $dataKeluarga->alamat,
            'dusun' => $dataKeluarga->dusun,
            'rt' => $dataKeluarga->rt,
            'rw' => $dataKeluarga->rw,
            'ekonomi' => $dataKeluarga->ekonomi,
            'created_at' => $dataKeluarga->created_at,
            'updated_at' =>$dataKeluarga->updated_at,
            'anggota' => $dataAnggota
        ];
        return $data;
    }
}
