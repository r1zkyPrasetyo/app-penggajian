<?php

namespace App\Http\Resources;

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
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
        ];      
    }
}
