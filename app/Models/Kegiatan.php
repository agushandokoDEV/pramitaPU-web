<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table='kegiatan';
    protected $keyType = 'string';
    protected $fillable = ['user_id','ambil_bahan_id','jenis','lab_id','antar_bahan_id','instansi_id','pengantaran_dokter_id','job_lainnya_id'];

    public function antarbahan()
    {
        return $this->belongsTo(AntarBahan::class, 'antar_bahan_id');
    }

    public function ambilbahan()
    {
        return $this->belongsTo(AmbilBahan::class, 'ambil_bahan_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function pengantarandokter()
    {
        return $this->belongsTo(PengantaranDokter::class, 'pengantaran_dokter_id');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function uraianpekerjaan()
    {
        return $this->belongsTo(UraianPekerjaan::class, 'uraian_pekerjaan_id');
    }

    public function lainnya()
    {
        return $this->belongsTo(JobLainnya::class, 'job_lainnya_id');
    }
    
    // public function dokter()
    // {
    //     return $this->hasMany(
    //         PengantaranDokter::class,
    //         'dokter_id',
    //         'id',
    //     );
    // }

    // public function tabung()
    // {
    //     return $this->hasManyThrough(
    //         TabungAmbilBahan::class,
    //         AmbilBahan::class, 
    //         'id',
    //         'ambil_bahan_id',
    //         'ambil_bahan_id',
    //         'id'
    //     );
    // }
    

    // public function tabung()
    // {
    //     return $this->belongsToMany(
    //         AmbilBahan::class,
    //         'tabung_ambil_bahan',
    //         'tabung_id',
    //         'ambil_bahan_id',
    //     );
    // }
}
