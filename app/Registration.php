<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $fillable =[
      "eventID", "userID",
    ];

    public function event(){
        return $this->hasOne('App\Event', 'id', 'eventID');
    }

    public function member(){
        return $this->hasOne('App\User', 'id', 'userID');
    }
}
