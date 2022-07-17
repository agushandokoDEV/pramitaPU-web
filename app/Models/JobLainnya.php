<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLainnya extends Model
{
    use HasFactory;

    protected $table='job_lainnya';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id','user_id','jenis_keg','tujuan','ket','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
