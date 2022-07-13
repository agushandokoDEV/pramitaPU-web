<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbilBahan extends Model
{
    use HasFactory;

    protected $table='ambil_bahan';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['user_id','lab_id','nama_pasien','yg_menyerahkan','created_at','yg_menerima','approved_at','approved_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function listtabung()
    {
        return $this->hasMany(
            TabungAmbilBahan::class,
            'ambil_bahan_id',
            'id',
        );
    }
}
