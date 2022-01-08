<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Validator;

class PegawaiControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::latest()->get();
        return response()->json([ProgramResource::collection($data), 'Programs fetched.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pegawai' => 'required|string|max:10',
            'total_gaji'   => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $dpegawai = Pegawai::updateOrCreate([
            'nama_pegawai' => $request->nama_pegawai,
            'total_gaji'   => $request->total_gaji,
         ]);

         return response()->json(['Pegawai created successfully.', new ProgramResource($dpegawai)]);


    }
}
