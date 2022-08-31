<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Warga;
use Illuminate\Http\Request;
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
}
