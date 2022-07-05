<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengantaranDokter extends Model
{
    use HasFactory;

    protected $table='pengantaran_dokter';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['user_id','jenis_keg','tujuan','ket','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
