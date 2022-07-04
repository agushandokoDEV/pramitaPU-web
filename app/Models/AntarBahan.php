<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntarBahan extends Model
{
    use HasFactory;
    
    protected $table='antar_bahan';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['user_id','lab_id','penerima','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
