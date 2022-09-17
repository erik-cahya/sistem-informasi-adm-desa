<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Carbon;
use Datatables;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->warga = new Warga();
        $this->surat = new Surat();
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Surat::select('*'))
            ->addIndexColumn()
            ->make(true);
        }

        $data = [
            'title' => "Data surat"
        ];

        return view('pages.surat', $data);
    }


    public function suratDomisili()
    {
        $params = [
            'nama_penanggung_jawab'=> 'Ferdian Arjutama Narwan',
            'jabatan_penanggung_jawab' => 'Kepala Desa',
            'alamat_penanggung_jawab' => 'Ini Alamat',
            'desa' => 'matanga',
            'kepala_desa' => 'Ferdian Arjun'
        ];
        $data = [
            'title' => 'Surat Domisili',
            'wargas' => Warga::get(),
            'params' => $params
        ];

        return view('pages.surat_domisili', $data);
    }

    public function createSuratDomisili(Request $request)
    {
         $request->validate([
                'no_surat' => 'required',
                'pembuat_nama' => 'required',
                'pembuat_jabatan' => 'required',
                'pembuat_alamat' => 'required',
                'nama_lengkap' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'status_nikah' => 'required',
                'pekerjaan' => 'required',
                'alamat_lengkap' => 'required',
                'no_ktp' => 'required',
                'tempat_surat' => 'required',
                'tgl_surat' => 'required',
                'kepala_desa' => 'required',              
            ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Domisili.rtf');

        //replace data
        $doc = str_replace('#NOSURAT',$request->no_surat,$doc);
        $doc = str_replace('#NAMAPENANGGUNG',$request->pembuat_nama,$doc);
        $doc = str_replace('#JABATANPENANGGUNG',$request->pembuat_jabatan,$doc);
        $doc = str_replace('#ALAMATPENANGGUNG',$request->pembuat_alamat,$doc);

        $doc = str_replace('#NAMA',$request->nama_lengkap,$doc);
        $doc = str_replace('#TEMPATLAHIR',$request->tempat_lahir,$doc);
        $doc = str_replace('#TANGGALLAHIR',(new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'),$doc);
        $doc = str_replace('#JENISKELAMIN',$request->jenis_kelamin,$doc);
        $doc = str_replace('#AGAMA',$request->agama,$doc);
        $doc = str_replace('#STATUS',$request->status_nikah,$doc);
        $doc = str_replace('#PEKERJAAN',$request->pekerjaan,$doc);
        $doc = str_replace('#ALAMATLENGKAP',$request->alamat_lengkap,$doc);
        $doc = str_replace('#NIK',$request->no_ktp,$doc);

        $doc = str_replace('#TEMPATSURAT',$request->tempat_surat,$doc);
        $doc = str_replace('#TGLSURAT',(new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'),$doc);
        $doc = str_replace('#KEPALADESA',$request->kepala_desa,$doc);

     
        $fileName = 'surat_domisili_'.$request->no_ktp.'_'.$request->tgl_surat.'.doc';

        //save document
        $data = Storage::put('public/surat/domisili/'.$fileName, $doc);

        //save data into database
        Surat::create([
            'jenis_surat' => 'Surat Domisili',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName ,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message'=>'Surat berhasil dibuat','fileName' => $fileName]);
    }

    public function getFile($fileName)
    {
       return response()->download(storage_path('app/public/surat/domisili/'.$fileName));
    }

    public function delete($id)
    {
        $data = $this->surat->find($id);

        DB::transaction(function() use ($data) {
            //delete file
            Storage::delete('public/surat/domisili/'.$data->nama_surat);

            //delete data
            $data->forceDelete();
        });
     
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
