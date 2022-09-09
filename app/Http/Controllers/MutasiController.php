<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Mutasi;
use Illuminate\Support\Facades\DB;

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
           
            Mutasi::create([
                'warga_id' => $request->id,
                'jenis_mutasi' => $request->type_mutasi,
                'tgl_keluar_masuk' => $request->tanggal_keluar_masuk ,
                'keterangan' => $request->keterangan
            ]);

            Warga::find($request->id)->update(['status_warga' => '0']);
           
        });
      
        return response()->json(['message'=>'Data berhasil di simpan.']);
    }

}
