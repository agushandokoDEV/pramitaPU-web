<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\UuidTrait;

class RoleHasPermissions extends Model
{
    use HasFactory,UuidTrait;

    protected $table = 'role_has_permissions';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $casts = [
    //     'permission_id' => 'uuid',
    //     'role_id' => 'uuid',
    // ];
}
