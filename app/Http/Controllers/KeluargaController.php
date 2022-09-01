<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class KeluargaController extends Controller
{
    public function index()
    {

        if (request()->ajax()) {
            return datatables()->of(Keluarga::select('*'))
            ->addIndexColumn()
            ->make(true);
        }
        $data = [
            'title' => "Data keluarga"
        ];

        return view('pages.keluarga', $data);
    }

    public function add()
    {
        $data = [
            'title' => "Tambah data keluarga",
            'wargas' => Warga::get()
        ];
        return view('pages.tambah-keluarga', $data);
    }

    public function create(Request $request)
    {
         $request->validate([
            'no_kk' => 'required|numeric|digits:16|unique:keluargas,no_kk',
            'alamat' => 'required|max:255',
            'dusun' => 'required|max:255',
            'rt' => 'required|numeric|max:255',
            'rw' => 'required|numeric|max:255',
            'ekonomi' => 'required',
            'anggotas' => 'required'
        ]);

        DB::transaction(function() use ($request) {
           
            $keluarga = Keluarga::create([
                'no_kk' => $request->no_kk,
                'kepala_keluarga' => $request->kepala_keluarga,
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
