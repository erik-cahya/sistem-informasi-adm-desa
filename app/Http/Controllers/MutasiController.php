<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Mutasi;
use App\Models\Dusun;
use Illuminate\Support\Facades\DB;

class MutasiController extends Controller
{
    public function __construct()
    {
        $this->warga = new Warga();
        $this->mutasi = new Mutasi();
        $this->dusun = new Dusun();
    }
    
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of($this->mutasi->getFullData())
            ->addIndexColumn()
            ->make(true);
        }

        $mutasi = ['Lahir','Masuk','Wafat','Keluar'];

        $data = [
            'title' => "Data Mutasi",
            'tipeMutasi' => $mutasi
        ];

        return view('pages.mutasi', $data);
    }

    public function show($id = null){

        if ($id == null) {
            $data = $this->mutasi->getFullData();

            return response()->json($data);
        }

        $data = $this->mutasi->getFullData($id);

        return response()->json($data);
    }

    public function mutasiMasuk()
    {
        $mutasi = ['Lahir', 'Masuk'];


        $data = [
            'title' => 'Mutasi masuk',
            'tipeMutasi' => $mutasi,
            'dusuns' => $this->dusun->dusuns()
        ];

        return view('pages.mutasi_masuk', $data);
    }

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
        if ($request->create == 'out') {
       
            $request->validate([
                'ktp' => 'required',
                'jenis_mutasi' => 'required|max:255',
                'tanggal_keluar_masuk' => 'required',
                'keterangan' => 'required'
            ]);

            DB::transaction(function() use ($request) {
            
                Mutasi::create([
                    'warga_id' => $request->ktp,
                    'jenis_mutasi' => $request->jenis_mutasi,
                    'tgl_keluar_masuk' => $request->tanggal_keluar_masuk ,
                    'keterangan' => $request->keterangan
                ]);

                Warga::find($request->ktp)->update(['status_warga' => '0']);
            
            });
        
            return response()->json(['message'=>'Data berhasil di simpan.']);
          
        }else{
            
            $request->validate([
                'no_ktp' => 'required|numeric|digits:16|unique:wargas,no_ktp',
                'nama_lengkap' => 'required|max:64|min:2|max:255',
                'agama' => 'required|alpha|max:255',
                'tempat_lahir' => 'required|max:255',
                'tgl_lahir' => 'required|max:255',
                'jenis_kelamin' => 'required|max:255',
                'alamat' => 'required|max:255',
                'dusun' => 'required|max:255',
                'golongan_darah' => 'required|max:255',
                'warga_negara' => 'required|max:255',
                'pendidikan' => 'required|max:255',
                'baca_tulis' => 'required|max:255',
                'pekerjaan' => 'required|max:255',
                'status_nikah' => 'required|max:255',

                'jenis_mutasi' => 'required|max:255',
                'tanggal_keluar_masuk' => 'required',
                'keterangan' => 'required'
            ]);

            DB::transaction(function() use ($request) {
                $newWarga = Warga::create([
                    'no_ktp' => $request->no_ktp,
                    'nama_lengkap' => $request->nama_lengkap,
                    'agama' => $request->agama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jenis_kelamin' =>  $request->jenis_kelamin,
                    'alamat' =>  $request->alamat,
                    'dusun' =>  $request->dusun,
                    'rt' =>  $request->rt,
                    'rw' =>  $request->rw,
                    'baca_tulis' =>  $request->baca_tulis,
                    'golongan_darah' =>  $request->golongan_darah,
                    'warga_negara' =>  $request->warga_negara,
                    'pendidikan' =>  $request->pendidikan,
                    'pekerjaan' =>  $request->pekerjaan,
                    'status_nikah' =>  $request->status_nikah,
                    'status_warga' => 1,
                ]);

                Mutasi::create([
                    'warga_id' => $newWarga->id,
                    'jenis_mutasi' => $request->jenis_mutasi,
                    'tgl_keluar_masuk' => $request->tanggal_keluar_masuk ,
                    'keterangan' => $request->keterangan
                ]);

            });
            

            return response()->json(['message'=>'Data berhasil di simpan.']);
        }
    }

    public function update(Request $request)
    {
       $request->validate([
            'id' => 'required',
            'jenis_mutasi' => 'required|max:255',
            'tgl_keluar_masuk' => 'required',
            'keterangan' => 'required'
        ]);

        $dataMutasi = $this->mutasi->find($request->id);

        $dataMutasi->update([
            'jenis_mutasi' => $request->jenis_mutasi,
            'tgl_keluar_masuk' => $request->tgl_keluar_masuk ,
            'keterangan' => $request->keterangan
        ]);
       
        return response()->json(['message'=>'Data berhasil diperbarui']);
    }

    public function delete($id)
    {
        $this->mutasi->find($id)->forceDelete(); 
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }

}
