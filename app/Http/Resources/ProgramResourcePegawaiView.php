<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResourcePegawaiView extends JsonResource
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
            'id'            => $this->id,
            'nama_pegawai'  => strtoupper(substr($this->nama_pegawai, 0, 6)),
            'total_gaji'    => number_format($this->total_gaji,2,".",","),
            'created_at'    => date_format($this->created_at,'Y-m-d'),
        ];    
    }
}
