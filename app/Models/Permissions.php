<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\UuidTrait;

class Permissions extends SpatiePermission
{
    use HasFactory,UuidTrait;

    protected $table = 'permissions';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $casts = [
    //     'id' => 'uuid',
    // ];
}
