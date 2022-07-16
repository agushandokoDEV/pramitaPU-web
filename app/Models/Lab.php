<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $table='lab';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['nama','createdAt'];
}
