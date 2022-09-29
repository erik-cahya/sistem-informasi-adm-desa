<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use App\Models\Keluarga;
use App\Models\Surat;
use App\Models\Mutasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
       //
    }

    public function index()
    {
        $data = [
            'user' => User::first(),
            'title' => 'Dashboard'
        ];
        return view('pages.home', $data);
    }

    public function getCountData($by)
    {
        $date = Carbon::now();
        $from = $date->startOfMonth()->format('Y-m-d');
        $to =  Carbon::createFromFormat('Y-m-d', $from)->endOfMonth()->format('Y-m-d');

        
        if ($by == 'month') {
            //dd($by);
            return response()->json([
                'penduduk' => Warga::whereBetween('created_at',[$from,$to])->get()->count(),
                'keluarga' => Keluarga::whereBetween('created_at',[$from,$to])->get()->count(),
                'surat' => Surat::whereBetween('created_at',[$from,$to])->get()->count(),
                'mutasi' => Mutasi::whereBetween('created_at',[$from,$to])->get()->count()
            ]);
        }

        if ($by == 'year') {
            return response()->json([
                'penduduk' => Warga::whereYear('created_at', Carbon::now()->year)->get()->count(),
                'keluarga' => Keluarga::whereYear('created_at', Carbon::now()->year)->get()->count(),
                'surat' => Surat::whereYear('created_at', Carbon::now()->year)->get()->count(),
                'mutasi' => Mutasi::whereYear('created_at', Carbon::now()->year)->get()->count()
            ]);
        }

        return response()->json([
            'penduduk' => Warga::get()->count(),
            'keluarga' => Keluarga::get()->count(),
            'surat' => Surat::get()->count(),
            'mutasi' => Mutasi::get()->count()
        ]);
        
    }

    public function getGenderData()
    {
        $dataL = Warga::where(['jenis_kelamin' => 'Laki-laki'])->get()->count();
        $dataP = Warga::where(['jenis_kelamin' => 'Perempuan'])->get()->count();

        return response()->json([
            'series' => [$dataL, $dataP],
            'labels' => ['Laki-laki', 'Perempuan']
        ]);
    }

    public function sortMonth()
    {
        $date = Carbon::now();
        $arrayMonth = [];
        $arrayDataKeluar = [];
        $arrayDataMasuk = [];

        for ($i=0; $i < 6 ; $i++) { 
            $arrayMonth[$i] = $date->format('M y');           
            $from = $date->startOfMonth()->format('Y-m-d');
            $to =  Carbon::createFromFormat('Y-m-d', $from)->endOfMonth()->format('Y-m-d');
           
            $arrayDataKeluar[$i] = Mutasi::whereIn('jenis_mutasi',['Keluar','Wafat'])->whereBetween('tgl_keluar_masuk',[$from,$to])->get()->count();
            $arrayDataMasuk[$i] = Mutasi::whereIn('jenis_mutasi',['Masuk','Lahir'])->whereBetween('tgl_keluar_masuk',[$from,$to])->get()->count();
     
        
            $date = $date->subMonth();

        }

        return response()->json([
            'categories' => $arrayMonth,
            'masuk' => $arrayDataMasuk,
            'keluar' => $arrayDataKeluar
        ]);
    }
 
}