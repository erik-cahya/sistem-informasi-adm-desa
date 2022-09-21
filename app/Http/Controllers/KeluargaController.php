<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use App\Models\DetailKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Datatables;

class KeluargaController extends Controller
{
    public function __construct()
    {
        $this->keluargas = new Keluarga();
        $this->detailKeluarga = new DetailKeluarga();
    }

    public function index()
    {

        if (request()->ajax()) {
            return datatables()->of($this->keluargas->getFullData())
            ->addIndexColumn()
            ->make(true);
        }
        $data = [
            'title' => "Data keluarga",
            'wargas' => Warga::get()
        ];

        return view('pages.keluarga', $data);
    }

    public function show($id = null){

        if ($id == null) {
            $data = $this->keluargas->getFullData();

            return response()->json($data);
        }

        $data = $this->keluargas->getFullData($id);

        return response()->json($data);
    }


    public function create(Request $request)
    {
         $request->validate([
            'no_kk' => 'required|numeric|digits:16|unique:keluargas,no_kk',
            'alamat' => 'required|max:255',
            'dusun' => 'required|max:255',
            'ekonomi' => 'required',
            'anggotas' => 'required'
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

    public function update(Request $request)
    {
         $request->validate([
            'no_kk' => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('keluargas', 'no_kk')->ignore($request->id),
            ],
            'alamat' => 'required|max:255',
            'dusun' => 'required|max:255',
            'ekonomi' => 'required',
            'anggotas' => 'required'
        ]);

         DB::transaction(function() use ($request) {  

            
            $this->detailKeluarga->where(['keluarga_id' => $request->id])->forceDelete();

            $keluarga = $this->keluargas->find($request->id);

            $keluarga->update([
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
                    'keluarga_id' => $request->id,
                    'warga_id' => $anggota['id'],
                    'status_anggota' => $anggota['status']
                ]);
            }

         });

        return response()->json(['message'=>'Data berhasil diperbarui']);
    }

    public function delete($id)
    {
        DB::transaction(function() use ($id) {  
            $this->detailKeluarga->where(['keluarga_id' => $id])->forceDelete();
            $this->keluargas->find($id)->forceDelete();        
        });
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
