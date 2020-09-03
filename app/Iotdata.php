<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iotdata extends Model
{
    protected $table = 'iotdata';

    public function device()
    {
        return $this->belongsTo('App\Device');
    }
}
