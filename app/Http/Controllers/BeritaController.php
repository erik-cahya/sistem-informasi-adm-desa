<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (request()->ajax()) {
            return datatables()->of(Berita::select('beritas.*','kategoris.nama')->join('kategoris', 'beritas.kategori', '=', 'kategoris.id'))
            ->addIndexColumn()
            ->make(true);
        }

        return view('pages.berita', [
            'title' => 'Berita',
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
            'title' => 'Tambah Berita',
            'kategori' => Kategori::get()
        ];

        return view('pages.addberita', $data);
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
            'berita' => 'required',
            'kategori' => 'required'            
        ]);

        $image = $request->file('thumbnail');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        
        $destinationPath = base_path('public/storage/images');
        $image->move($destinationPath, $image_name);

        Berita::create([
            'judul' => $request->judul,
            'creator' => $request->creator,
            'berita' => $request->berita,
            'thumbnail' => $image_name,
            'kategori' => $request->kategori
        ]);


        return redirect('berita')->with('success', 'Berita telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'berita' => Berita::find($id),
            'title' => 'Berita',
            'kategori' => Kategori::get()
        ];

        return view('pages.editberita', $data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        if ($request->thumbnail == null) {
            $request->validate([
                'judul' => 'required',
                'creator' => 'required',
                'berita' => 'required',
                'kategori' => 'required',
                'id'    => 'required'
            ]);
            $update = Berita::find($request->id)->update($request->all());

        } else {
            $image = $request->file('thumbnail');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            
            $destinationPath = base_path('public/storage/images');
            $image->move($destinationPath, $image_name);

            $data = [
                'judul' => $request->judul,
                'creator' => $request->creator,
                'berita' => $request->berita,
                'thumbnail' => $image_name,
                'kategori' => $request->kategori
            ];

            Berita::
            where(['id' => $request->id])
            ->update($data);


        }
        return redirect('berita')->with('success', 'Berita telah dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $data = Berita::find($id);

        $data->forceDelete();
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
