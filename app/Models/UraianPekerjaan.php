<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianPekerjaan extends Model
{
    use HasFactory;

    protected $table='uraian_pekerjaan';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['id','dokter_id','user_id','created_at'];
}
