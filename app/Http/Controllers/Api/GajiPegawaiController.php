<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Http\Resources\ProgramResourcePegawaiView;
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
        ];
        $data = GajiPegawai::select($columns)->paginate(1);
        foreach ($data as $index => $rows) {
            $data[$index]['total_gaji_diterima']      = number_format($rows['total_gaji_diterima'], 0, ".", ".");
            $data[$index]['waktu']                    = date('D/M/Y H:m', strtotime($rows['created_at']));

            $ambildPegawai = Pegawai::where('id',$rows['id_pegawai'])->first();
            $data[$index]['pegawai']                  = [
                'nama_pegawai'                       => strtoupper($ambildPegawai->nama_pegawai),
                'total_gaji'                         => number_format($ambildPegawai->total_gaji, 0, ".", ".")
            ];

            foreach ($rows as $key => $value) {
                if (array_key_exists($key, $columns) && !is_null($value))
                    $data[$index][$key] = $columns[$key][$value];
            }
        }

        return new ProgramResourcePegawaiView($data);
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
                'total_gaji_diterima' => $cekIdPegawai->total_gaji,
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
