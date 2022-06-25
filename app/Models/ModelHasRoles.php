<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\UuidTrait;

class ModelHasRoles extends Model
{
    use HasFactory,UuidTrait;

    protected $table = 'model_has_roles';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'role_id' => 'uuid',
        'model_id' => 'uuid',
    ];
}
