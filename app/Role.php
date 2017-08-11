<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    static $defaultRoleId = 2;
    protected $table = "roles";
    protected $fillable = [
        'role',
    ];
}
