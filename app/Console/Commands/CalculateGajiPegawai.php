<?php

namespace App\Console\Commands;

use App\Models\GajiPegawai;
use App\Models\Pegawai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CalculateGajiPegawai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kledo:bikin-data-contoh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat contoh data Gaji Karyawan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
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

        $this->comment('');
        $this->comment('▄▄ ▄▄ ▄▄   █▀ █▀▀ █░░ █▀▀ █▀ ▄▀█ █   ▄▄ ▄▄ ▄▄');
        $this->comment('░░ ░░ ░░   ▄█ ██▄ █▄▄ ██▄ ▄█ █▀█ █   ░░ ░░ ░░');
        $this->comment('');
    }


}
