<?php

namespace App\Jobs;

use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CalculateGajiPegawai implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dPegawai = Pegawai::all();

        foreach ($dPegawai as $value) {
            $dpegawai = GajiPegawai::updateOrCreate([
                'id_pegawai' => $value->id,
                'tota_gaji_diterima' => $value->total_gaji,
            ]);
        }

        Log::info("CalculateGajiPegawai done");
    }
}
