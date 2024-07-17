<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Surat;
use App\Models\Parameter;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Carbon;
use Datatables;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->warga = new Warga();
        $this->surat = new Surat();
        $this->pengajuanSurat = new PengajuanSurat();

        $this->params = [
            'nama_desa' => Parameter::where('param', 'nama_desa')->first()->value,
            'kepala_desa' => Parameter::where('param', 'kepala_desa')->first()->value
        ];
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

    public function getFile($fileName)
    {
        return response()->download(storage_path('app/public/surat/' . $fileName));
    }

    public function delete($id)
    {
        $data = $this->surat->find($id);

        DB::transaction(function () use ($data) {
            //delete file
            Storage::delete('public/surat/domisili/' . $data->nama_surat);

            //delete data
            $data->forceDelete();
        });


        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function suratDomisili()
    {
        $data = [
            'title' => 'Surat Domisili',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_domisili', $data);
    }

    public function createSuratDomisili(Request $request)
    {
        // dd($request->all());
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
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#AGAMA', $request->agama, $doc);
        $doc = str_replace('#STATUS', $request->status_nikah, $doc);
        $doc = str_replace('#PEKERJAAN', $request->pekerjaan, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);
        $doc = str_replace('#NIK', $request->no_ktp, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_domisili_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Domisili',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganPekerjaanOrangTua()
    {
        $data = [
            'title' => 'Surat Keterangan Pekerjaan Orang Tua',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];

        return view('pages.surat_keterangan_pekerjaan_orang_tua', $data);
    }

    public function createSuratKeteranganPekerjaanOrangTua(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'pembuat_nama' => 'required',
            'pembuat_jabatan' => 'required',
            'pembuat_alamat' => 'required',

            'nama_lengkap_anak' => 'required',
            'pekerjaan_anak' => 'required',

            'no_ktp_ayah' => 'required',
            'nama_lengkap_ayah' => 'required',
            'tempat_lahir_ayah' => 'required',
            'tgl_lahir_ayah' => 'required',
            'jenis_kelamin_ayah' => 'required',
            'agama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'alamat_lengkap_ayah' => 'required',

            'no_ktp_ibu' => 'required',
            'nama_lengkap_ibu' => 'required',
            'tempat_lahir_ibu' => 'required',
            'tgl_lahir_ibu' => 'required',
            'jenis_kelamin_ibu' => 'required',
            'agama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'alamat_lengkap_ibu' => 'required',
            'nama_lengkap_anak' => 'required',
            'pekerjaan_anak' => 'required',

            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Pekerjaan-orang-tua.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);


        $doc = str_replace('#NAMAAYAH', $request->nama_lengkap_ayah, $doc);
        $doc = str_replace('#TEMPATLAHIRAYAH', $request->tempat_lahir_ayah, $doc);
        $doc = str_replace('#TANGGALLAHIRAYAH', (new Carbon($request->tgl_lahir_ayah))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMINAYAH', $request->jenis_kelamin_ayah, $doc);
        $doc = str_replace('#AGAMAAYAH', $request->agama_ayah, $doc);
        $doc = str_replace('#PEKERJAANAYAH', $request->pekerjaan_ayah, $doc);
        $doc = str_replace('#ALAMATLENGKAPAYAH', $request->alamat_lengkap_ayah, $doc);

        $doc = str_replace('#NAMAIBU', $request->nama_lengkap_ibu, $doc);
        $doc = str_replace('#TEMPATLAHIRIBU', $request->tempat_lahir_ibu, $doc);
        $doc = str_replace('#TANGGALLAHIRIBU', (new Carbon($request->tgl_lahir_ibu))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMINIBU', $request->jenis_kelamin_ibu, $doc);
        $doc = str_replace('#AGAMAIBU', $request->agama_ibu, $doc);
        $doc = str_replace('#PEKERJAANIBU', $request->pekerjaan_ibu, $doc);
        $doc = str_replace('#ALAMATLENGKAPIBU', $request->alamat_lengkap_ibu, $doc);

        $doc = str_replace('#NAMAANAK', $request->nama_lengkap_anak, $doc);
        $doc = str_replace('#PEKERJAANANAK', $request->pekerjaan_anak, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);

        $fileName = 'surat_keterangan_pekerjaan_orang_tua_' . $request->nama_lengkap_anak . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat keterangan pekerjaan orang tua',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganBerlakuanBaik()
    {
        $data = [
            'title' => 'Surat Keterangan Berlakuan Baik',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_keterangan_berlakuan_baik', $data);
    }

    public function createsuratKeteranganBerlakuanBaik(Request $request)
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
            'pekerjaan' => 'required',
            'alamat_lengkap' => 'required',
            'no_ktp' => 'required',
            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan Berlakuan-Baik.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#PEKERJAAN', $request->pekerjaan, $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_keterangan_berlakuan_baik_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Keterangan Berlakuan Baik',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganEkonomiLemah()
    {
        $data = [
            'title' => 'Surat Keterangan Ekonomi Lemah',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_keterangan_ekonomi_lemah', $data);
    }

    public function createSuratKeteranganEkonomiLemah(Request $request)
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
            'warga_negara' => 'required',
            'alamat_lengkap' => 'required',
            'no_ktp' => 'required',
            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Ekonomi-Lemah.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#AGAMA', $request->agama, $doc);
        $doc = str_replace('#WN', $request->warga_negara, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_keterangan_ekonomi_lemah_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Keterangan Ekonomi Lemah',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganBelumMenikah()
    {
        $data = [
            'title' => 'Surat Keterangan Belum Menikah',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_keterangan_belum_menikah', $data);
    }

    public function createSuratKeteranganBelumMenikah(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'pembuat_nama' => 'required',
            'pembuat_jabatan' => 'required',
            'pembuat_alamat' => 'required',
            'nama_lengkap' => 'required',
            'no_ktp' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'warga_negara' => 'required',
            'alamat_lengkap' => 'required',
            'keperluan' => 'required',
            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Belum-Menikah.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#NIK', $request->no_ktp, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#AGAMA', $request->agama, $doc);
        $doc = str_replace('#WN', $request->warga_negara, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);
        $doc = str_replace('#KEPERLUHAN', $request->keperluan, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_keterangan_belum_menikah_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Keterangan Belum Menikah',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganKepemilikan()
    {
        $data = [
            'title' => 'Surat Keterangan Kepemilikan',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_keterangan_kepemilikan', $data);
    }

    public function createSuratKeteranganKepemilikan(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'pembuat_nama' => 'required',
            'pembuat_jabatan' => 'required',
            'pembuat_alamat' => 'required',
            'nama_lengkap' => 'required',
            'no_ktp' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_nikah' => 'required',
            'pekerjaan' => 'required',
            'alamat_lengkap' => 'required',
            'pemilik_dari' => 'required',
            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Kepemilikan.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#NIK', $request->no_ktp, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#AGAMA', $request->agama, $doc);
        $doc = str_replace('#STATUS', $request->status_nikah, $doc);
        $doc = str_replace('#PEKERJAAN', $request->pekerjaan, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);

        $doc = str_replace('#PD', $request->pemilik_dari, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_keterangan_kepemilikan_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Keterangan Kepemilikan',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }

    public function suratKeteranganUsaha()
    {
        $data = [
            'title' => 'Surat Keterangan Usaha',
            'wargas' => Warga::get(),
            'params' => $this->params
        ];
        return view('pages.surat_keterangan_usaha', $data);
    }

    public function createSuratKeteranganUsaha(Request $request)
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
            'warga_negara' => 'required',
            'alamat_lengkap' => 'required',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'no_ktp' => 'required',
            'tempat_surat' => 'required',
            'tgl_surat' => 'required',
            'kepala_desa' => 'required',
        ]);

        //get document template
        $doc = Storage::get('template/Surat-Keterangan-Usaha.rtf');

        //replace data
        $doc = str_replace('#NOSURAT', $request->no_surat, $doc);
        $doc = str_replace('#NAMAPENANGGUNG', $request->pembuat_nama, $doc);
        $doc = str_replace('#JABATANPENANGGUNG', $request->pembuat_jabatan, $doc);
        $doc = str_replace('#ALAMATPENANGGUNG', $request->pembuat_alamat, $doc);

        $doc = str_replace('#NAMA', $request->nama_lengkap, $doc);
        $doc = str_replace('#TEMPATLAHIR', $request->tempat_lahir, $doc);
        $doc = str_replace('#TANGGALLAHIR', (new Carbon($request->tgl_lahir))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#JENISKELAMIN', $request->jenis_kelamin, $doc);
        $doc = str_replace('#AGAMA', $request->agama, $doc);
        $doc = str_replace('#WN', $request->warga_negara, $doc);
        $doc = str_replace('#ALAMATLENGKAP', $request->alamat_lengkap, $doc);

        $doc = str_replace('#USAHA', $request->nama_usaha, $doc);
        $doc = str_replace('#ALAMATUSAHA', $request->alamat_usaha, $doc);

        $doc = str_replace('#TEMPATSURAT', $request->tempat_surat, $doc);
        $doc = str_replace('#TGLSURAT', (new Carbon($request->tgl_surat))->isoFormat('D MMMM Y'), $doc);
        $doc = str_replace('#KEPALADESA', $request->kepala_desa, $doc);


        $fileName = 'surat_keterangan_usaha_' . $request->nama_lengkap . '_' . $request->tgl_surat . '.doc';

        //save document
        $data = Storage::put('public/surat/' . $fileName, $doc);

        //save data into database
        Surat::create([
            'warga_id' => $request->warga_id,
            'jenis_surat' => 'Surat Keterangan Usaha',
            'no_surat' => $request->no_surat,
            'nama_surat' => $fileName,
            'tanggal_surat' => $request->tgl_surat
        ]);

        return response()->json(['message' => 'Surat berhasil dibuat', 'fileName' => $fileName]);
    }



    // ######################################## Pengajuan Surat

    public function pengajuanSurat()
    {
        if (request()->ajax()) {
            return datatables()->of(DB::table('wargas')->join('pengajuan_surat', 'pengajuan_surat.warga_id', '=', 'wargas.id')->get())
                ->addIndexColumn()
                ->make(true);
        }

        $data = [
            'title' => "Data surat"
        ];

        if (auth()->user()->level === 'warga') {
            return view('pages.user_warga.pengajuan_surat', $data);
        } elseif (auth()->user()->level === 'admin') {

            return view('pages.pengajuan_surat', $data);
        }
    }

    public function createPengajuanSurat(Request $request)
    {

        $fileName1 = auth()->user()->name . '_document1.' . $request->file1->extension();
        $fileName2 = auth()->user()->name . '_document2.' . $request->file2->extension();

        PengajuanSurat::create([
            'warga_id' => DB::table('users')->select('wargas.id')->join('wargas', 'wargas.no_ktp', '=', 'users.username')->where('wargas.no_ktp', '=', auth()->user()->username)->first()->id,
            'jenis_surat' => $request->jenis_surat,
            'nama_surat' => $request->nama_surat,
            'no_wa' => $request->no_wa,
            'document1' => $fileName1,
            'document2' => $fileName2,
            'keterangan' => $request->keterangan,
            'status' => 'pending'
        ]);
        // move image to storage link folder
        $request->file('file1')->move(public_path('storage/surat-images'), $fileName1);
        $request->file('file2')->move(public_path('storage/surat-images'), $fileName2);

        return redirect('surat-saya');
    }

    public function listPengajuan()
    {
        if (request()->ajax()) {
            return datatables()->of(DB::table('wargas')->join('pengajuan_surat', 'pengajuan_surat.warga_id', '=', 'wargas.id')->where('no_ktp', auth()->user()->username)->get())
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'title' => "Data surat",
        ];

        return view('pages.user_warga.list_pengajuan', $data);
    }

    public function suratSaya()
    {
        // dd(Auth::user()->level);
        if (request()->ajax()) {
            return datatables()->of(DB::table('wargas')->join('surats', 'surats.warga_id', '=', 'wargas.id')->where('no_ktp', auth()->user()->username)->get())
                ->addIndexColumn()
                ->make(true);
        }

        $data = [
            'title' => "Data surat",
        ];

        return view('pages.user_warga.surat_saya', $data);
    }

    public function deletePengajuanSurat($id)
    {
        PengajuanSurat::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function show($id = null)
    {
        if ($id == null) {
            $data = DB::table('wargas')->join('pengajuan_surat', 'pengajuan_surat.warga_id', '=', 'wargas.id')->get();
            return response()->json($data);
        }

        $data = PengajuanSurat::select('pengajuan_surat.*', 'wargas.no_ktp', 'wargas.nama_lengkap')->join('wargas', 'wargas.id', '=', 'pengajuan_surat.warga_id')->where(['pengajuan_surat.id' => $id])->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $dataMutasi = PengajuanSurat::find($request->id);
        $dataMutasi->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }
}
