<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $fillable = [
      "posterPath", "eventName", "seatCount", "eventDate",
    ];
}
