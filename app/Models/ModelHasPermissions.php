<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\UuidTrait;

class ModelHasPermissions extends Model
{
    use HasFactory,UuidTrait;

    protected $table = 'model_has_permissions';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $casts = [
    //     'permission_id'=>'uuid',
    //     'model_uuid' => 'uuid',
    // ];
}
