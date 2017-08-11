<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $primaryKey = 'id';
    protected $table = "colleges";
    protected $fillable = [
        'collegeDepartment',
    ];
}
