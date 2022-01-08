<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Http\Resources\ProgramResourceGajiPegawaiView;
use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Validator;

class GajiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GajiPegawai::with('pegawai')->latest()->paginate(2);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekIdPegawai = Pegawai::where('nama_pegawai',$request->nama_pegawai)->first();
        if (!empty($cekIdPegawai->id)) {
            $dpegawai = GajiPegawai::updateOrCreate([
                'id_pegawai' => $cekIdPegawai->id,
                'tota_gaji_diterima' => $cekIdPegawai->total_gaji,
             ]);
            return response()->json(['Pegawai created successfully.', new ProgramResourceGajiPegawai($dpegawai)]);
        }else{
            return response()->json([
                'status'    => 400,
                'message'   => 'Pegawai Tidak Ada'
            ]);       

        }
        


    }

}
