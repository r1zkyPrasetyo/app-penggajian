<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SurveyMember;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Log;
use DB;
class AgeGenerateCalculate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siop:assign-calculate-umur-member';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghitung umur setiap SurveyMember berdasarkan kolom tanggal_lahir';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('');
        $this->comment('*** Catatan ***');
        $this->comment('Menghitung umur untuk semua SurveyMember membutuhkan');
        $this->comment('waktu yang lumayan.');
        $this->comment('Tunggulah sampai proses penghitungan selesai.');
        $this->comment('');

        $tanggal_lahir_null_members   = SurveyMember::all();
        foreach ($tanggal_lahir_null_members as $value) {
            if (! is_null($value->tanggal_lahir) != 0000-00-00) {
                $timezone  = new \DateTimeZone('Asia/Jakarta');
                $umur      = \DateTime::createFromFormat('Y-m-d', $value->tanggal_lahir, $timezone)
                ->diff(new \DateTime('now', $timezone))
                ->y;
            }else {
                $umur = 0;
            }
            $data = SurveyMember::find($value->id);
            $data->umur = $umur;
            $data->save();
            Log::info("Hitung Umur: $value->tanggal_lahir $umur");
        }
        $this->comment('');
        $this->comment('▄▄ ▄▄ ▄▄   █▀ █▀▀ █░░ █▀▀ █▀ ▄▀█ █   ▄▄ ▄▄ ▄▄');
        $this->comment('░░ ░░ ░░   ▄█ ██▄ █▄▄ ██▄ ▄█ █▀█ █   ░░ ░░ ░░');
        $this->comment('');
    }
}
