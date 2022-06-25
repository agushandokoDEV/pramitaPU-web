<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends Model
{
    use HasFactory;

    protected $table='aktifitas';
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
    public function tabung()
    {
        return $this->belongsTo(Tabung::class);
    }
}
