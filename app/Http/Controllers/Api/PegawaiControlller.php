<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Http\Resources\ProgramResourceGajiPegawaiView;
use App\Http\Resources\ProgramResourcePegawaiView;
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

        $data = Pegawai::orderBy('created_at', 'desc')->paginate(2);
        foreach ($data as $index => $rows) {
            $data[$index]['nama_pegawai']             = strtoupper(substr($rows['nama_pegawai'], 0, 6));
            $data[$index]['total_gaji']               = number_format($rows['total_gaji'],2,".",",");
            $data[$index]['created_at']               = date_format($rows['created_at'],'Y-m-d');
        }
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pegawai' => 'required|string|max:10|unique:pegawai,nama_pegawai',
            'total_gaji'   => 'required|integer|',
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
