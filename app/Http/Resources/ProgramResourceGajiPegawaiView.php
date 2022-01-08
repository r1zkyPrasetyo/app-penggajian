<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResourceGajiPegawaiView extends JsonResource
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
            'id'                     => $this->id,
            'id_pegawai'             => strtoupper($this->id_pegawai),
            'total_gaji_diterima'    => number_format($this->tota_gaji_diterima,0,".","."),
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ];  
    }
}
