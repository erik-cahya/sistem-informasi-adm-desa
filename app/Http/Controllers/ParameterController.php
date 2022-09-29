<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameter;
use Datatables;

class ParameterController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Parameter::select('*'))
            ->addIndexColumn()
            ->make(true);
        }
        $data = [
            'title' => "Parameter aplikasi"
        ];

        return view('pages.parameters', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'param' => 'required|max:128|unique:parameters,param',
            'value' => 'required|max:128',
            'keterangan' => 'required'
        ]);

        $data = new Parameter();
        $data->param = $request->param;
        $data->value = $request->value;
        $data->keterangan = $request->keterangan;
        $data->save();

        return response()->json(['message'=>'Data berhasil disimpan.']);
    }

    public function show($id){
        $data = Parameter::find($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = Parameter::find($request->id);

        $request->validate([
            'param' => 'required|max:128',
            'value' => 'required|max:128',
            'keterangan' => 'required'
        ]);

        $data->update([
            'param' => $request->param,
            'value' => $request->value,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(['message'=>'Data berhasil diperbarui']);
    }

     public function delete($id)
    {
        $data = Parameter::find($id);

        $data->forceDelete();
        
        return response()->json(['message'=>'Data berhasil dihapus']);
    }

}
