<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    protected $table = 'pegawai';
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function gaji()
    {
        return $this->hasMany(GajiPegawai::class);
    }
}
