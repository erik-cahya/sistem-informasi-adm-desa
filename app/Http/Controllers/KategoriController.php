<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Kategori::select('*'))
            ->addIndexColumn()
            ->make(true);
        }


        $data = [
            'title' => "Data Kategori"
        ];

        return view('pages.kategori', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $attributes = request()->validate([
            'nama' => 'required|max:64|min:2|max:255'
        ]);

        $post = Kategori::create($attributes);

        return response()->json(['message'=>'Data berhasil di simpan.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kategori::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        // $data = Warga::find($id);
        $data = $this->kategori->getFullData($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:64|min:2|max:255',
            'id' => 'required|max:255',
        ]);

        $update = Kategori::find($request->id)->update($request->all());

        return response()->json(['message'=>'Data berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $data = Kategori::find($id);

        $data->forceDelete();
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}
