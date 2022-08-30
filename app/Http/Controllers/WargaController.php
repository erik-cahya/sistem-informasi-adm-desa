<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Datatables;

class WargaController extends Controller
{
     public function __construct()
    {
        $this->warga = new Warga();
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of($this->warga->all())
            ->addIndexColumn()
            ->make(true);
        }
        $data = [
            'title' => "Data penduduk"
        ];

        return view('pages.wargas', $data);
    }

     public function create()
    {
        $attributes = request()->validate([
            'no_ktp' => 'required|numeric|digits:16|unique:wargas,no_ktp',
            'nama_lengkap' => 'required|max:64|min:2|max:255',
            'agama' => 'required|alpha|max:255',
            'tempat_lahir' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'alamat' => 'required|max:255',
            'dusun' => 'required|max:255',
            'rt' => 'required|numeric|max:255',
            'rw' => 'required|numeric|max:255',
            'golongan_darah' => 'required|max:255',
            'warga_negara' => 'required|max:255',
            'pendidikan' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'status_nikah' => 'required|max:255',
            'status_warga' => 'required',
        ]);

        $post = Warga::create($attributes);

        return response()->json(['message'=>'Data berhasil di simpan.']);
    }

    public function show($id){
        $data = Warga::find($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_ktp' => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('wargas', 'no_ktp')->ignore($request->id),
            ],
            'nama_lengkap' => 'required|max:64|min:2|max:255',
            'agama' => 'required|alpha|max:255',
            'tempat_lahir' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'alamat' => 'required|max:255',
            'dusun' => 'required|max:255',
            'rt' => 'required|numeric|max:255',
            'rw' => 'required|numeric|max:255',
            'golongan_darah' => 'required|max:255',
            'warga_negara' => 'required|max:255',
            'pendidikan' => 'required|max:255',
            'pekerjaan' => 'required|max:255',
            'status_nikah' => 'required|max:255',
            'status_warga' => 'required',
        ]);

        $update = Warga::find($request->id)->update($request->all());

        return response()->json(['message'=>'Data berhasil diperbarui']);
    }

    public function delete($id)
    {
        $delete = $this->warga->find($id);

        $delete->forceDelete();
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
