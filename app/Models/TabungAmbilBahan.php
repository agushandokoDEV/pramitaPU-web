<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabungAmbilBahan extends Model
{
    use HasFactory;

    protected $table='tabung_ambil_bahan';
    protected $keyType = 'string';
    protected $fillable = ['ambil_bahan_id','tabung_id','jumlah'];
    public $timestamps = false;

    public function tabung()
    {
        return $this->belongsTo(Tabung::class,'tabung_id');
    }
}
