<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramResourceGajiPegawai;
use App\Http\Resources\ProgramResourceGajiPegawaiView;
use App\Http\Resources\ProgramResourcePegawaiView;
use App\Models\Pegawai;
use Carbon\Carbon;
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
        $columns = [
            'nama_pegawai',
            'total_gaji',
            'created_at'
        ];
        $data = Pegawai::orderBy('created_at', 'desc')->select($columns)->paginate(2);
        foreach ($data as $index => $rows) {
            $data[$index]['nama_pegawai']             = strtoupper(substr($rows['nama_pegawai'], 0, 6));
            $data[$index]['total_gaji']               = number_format($rows['total_gaji'], 0, ".", ".");
            $data[$index]['created_at']               = Carbon::parse($rows['created_at'])->format('D/M/Y');

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
            'nama_pegawai' => 'required|string|max:10|unique:pegawai,nama_pegawai',
            'total_gaji'   => 'required|integer|',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if ($request->total_gaji <= '4000000') {
            return response()->json([
                'status'    => 400,
                'message'   => 'Total Gaji Minimal 4000000 '
            ]);
        } elseif ($request->total_gaji >= '10000000') {
            return response()->json([
                'status'    => 400,
                'message'   => 'Total Gaji Maksimal 10000000 '
            ]);
        }
        
        $dpegawai = Pegawai::updateOrCreate([
            'nama_pegawai' => $request->nama_pegawai,
            'total_gaji'   => $request->total_gaji,
        ]);

        return response()->json(['Pegawai created successfully.', new ProgramResource($dpegawai)]);
    }
}
