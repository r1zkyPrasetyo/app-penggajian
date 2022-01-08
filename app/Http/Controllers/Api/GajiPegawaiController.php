<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class GajiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'id_pegawai',
            'tota_gaji_diterima',
            'created_at'
        ];
        $data = GajiPegawai::with('pegawai')->select($columns)->latest()->paginate(2);
        foreach ($data as $index => $rows) {
            $data[$index]['tota_gaji_diterima']       = number_format($rows['tota_gaji_diterima'], 2, ".", ",");

            foreach ($rows as $key => $value) {
                if (array_key_exists($key, $columns) && !is_null($value))
                    $data[$index][$key] = $columns[$key][$value];
            }
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
        $cekIdPegawai = Pegawai::where('nama_pegawai', $request->nama_pegawai)->first();
        if (!empty($cekIdPegawai->id)) {
            $dpegawai = GajiPegawai::updateOrCreate([
                'id_pegawai' => $cekIdPegawai->id,
                'tota_gaji_diterima' => $cekIdPegawai->total_gaji,
            ]);
            return response()->json(['Gaji Pegawai created successfully.', new ProgramResourceGajiPegawai($dpegawai)]);
        } else {
            return response()->json([
                'status'    => 400,
                'message'   => 'Pegawai Tidak Ada'
            ]);
        }
    }
}
