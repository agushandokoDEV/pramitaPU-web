<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table='kegiatan';
    protected $keyType = 'string';
    protected $fillable = ['user_id','ambil_bahan_id','jenis','lab_id'];

    public function ambilbahan()
    {
        return $this->belongsTo(AmbilBahan::class, 'ambil_bahan_id');
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function tabung()
    {
        return $this->hasMany(
            TabungAmbilBahan::class,
            'ambil_bahan_id',
            'ambil_bahan_id',
        );
    }

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
