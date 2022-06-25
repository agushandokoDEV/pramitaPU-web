<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabung extends Model
{
    use HasFactory;

    protected $table='tabung';
    protected $keyType = 'string';
}
