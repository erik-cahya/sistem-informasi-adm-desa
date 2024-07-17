<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (request()->ajax()) {
            return datatables()->of(Announce::select('announces.*'))
            ->addIndexColumn()
            ->make(true);
        }

        return view('pages.pengumuman', [
            'title' => 'Pengumuman',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data = [
            'title' => 'Tambah Pengumuman',
            'kategori' => Kategori::get()
        ];

        return view('pages.addpengumuman', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $request->validate([
            'judul' => 'required',
            'creator' => 'required',
            'pengumuman' => 'required'            
        ]);

        Announce::create([
            'judul' => $request->judul,
            'creator' => $request->creator,
            'pengumuman' => $request->pengumuman
        ]);


        return redirect('pengumuman')->with('success', 'Pengumuman telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announce  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announce  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'pengumuman' => Announce::find($id),
            'title' => 'Pengumuman',
        ];

        return view('pages.editpengumuman', $data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $pengumuman)
    {
        if ($request->thumbnail == null) {
            $request->validate([
                'judul' => 'required',
                'creator' => 'required',
                'pengumuman' => 'required',
                'id'    => 'required'
            ]);
            $update = Announce::find($request->id)->update($request->all());

        } else {
            $data = [
                'judul' => $request->judul,
                'creator' => $request->creator,
                'pengumuman' => $request->pengumuman
            ];

            Announce::
            where(['id' => $request->id])
            ->update($data);


        }
        return redirect('pengumuman')->with('success', 'Pengumuman telah dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $data = Announce::find($id);

        $data->forceDelete();
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
