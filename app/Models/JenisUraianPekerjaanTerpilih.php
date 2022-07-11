<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUraianPekerjaanTerpilih extends Model
{
    use HasFactory;

    protected $table='jenis_uraian_pekerjaan_terpilih';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id','pengantaran_dokter_id','jenis_uraian_pekerjaan_id'];

    public function jenis()
    {
        return $this->belongsTo(JenisUraianPekerjaan::class, 'jenis_uraian_pekerjaan_id');
    }
}
