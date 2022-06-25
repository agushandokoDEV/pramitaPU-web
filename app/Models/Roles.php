<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use App\UuidTrait;

class Roles extends SpatieRole
{
    use HasFactory,UuidTrait;

    protected $table = 'roles';
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $casts = [
    //     'id' => 'uuid',
    // ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'role_id');
    // }
}
