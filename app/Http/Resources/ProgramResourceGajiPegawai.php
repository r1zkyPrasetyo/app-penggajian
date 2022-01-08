<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResourceGajiPegawai extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'id_pegawai'            => $this->id_pegawai,
            'tota_gaji_diterima'    => $this->tota_gaji_diterima,
            'created_at'            => Carbon::parse($this->created_at)->format('D/M/Y'),
            'updated_at'            => Carbon::parse($this->updated_at)->format('D/M/Y'),
        ];      
    }
}
