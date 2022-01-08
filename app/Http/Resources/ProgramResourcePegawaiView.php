<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'total_gaji'    => number_format($this->total_gaji,0,".","."),
            'created_at'            => Carbon::parse($this->created_at)->format('D/M/Y'),
        ];    
    }
}
