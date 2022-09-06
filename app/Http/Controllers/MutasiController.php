<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class MutasiController extends Controller
{
    public function mutasiKeluar()
    {
        $mutasi = ['Keluar', 'Wafat'];

        $data = [
            'title' => 'Mutasi keluar',
            'wargas' => Warga::get(),
            'tipeMutasi' => $mutasi
        ];

        return view('pages.mutasi_keluar', $data);
    }

    public function create(Request $request)
    {
         $request->validate([
            'id' => 'required',
            'type_mutasi' => 'required|max:255',
            'tanggal_keluar_masuk' => 'required',
            'keterangan' => 'required'
        ]);

        DB::transaction(function() use ($request) {
           
            $keluarga = Keluarga::create([
                'no_kk' => $request->no_kk,
                'alamat' => $request->alamat,
                'dusun' => $request->dusun ,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'ekonomi' => $request->ekonomi
            ]);

            $anggotas = $request->anggotas;
            foreach($anggotas as $anggota){
                DetailKeluarga::create([
                    'keluarga_id' => $keluarga->id,
                    'warga_id' => $anggota['id'],
                    'status_anggota' => $anggota['status']
                ]);
            }
        });
      
        return response()->json(['message'=>'Data berhasil di simpan.']);
    }

}
