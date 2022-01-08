<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
        $columns = [
            'id_pegawai',
            'total_gaji_diterima',
            'created_at'
        ];
        $data = GajiPegawai::with('pegawai')->select($columns)->latest()->paginate(2);
        foreach ($data as $index => $rows) {
            $data[$index]['total_gaji_diterima']       = number_format($rows['total_gaji_diterima'], 0, ".", ".");

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
        $validator = Validator::make($request->all(), [
            'id_pegawai'   => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $cekIdPegawai = Pegawai::find($request->id_pegawai);
        if (!empty($cekIdPegawai->id)) {
            $dpegawai = GajiPegawai::updateOrCreate([
                'id_pegawai'         => $cekIdPegawai->id,
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

    public function batch(Request $request)
    {
        Artisan::call("kledo:bikin-data-contoh-gaji-pegawai");
    }
}
