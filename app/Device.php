<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    public function iotDataSets()
    {
        return $this->hasMany('App\Iotdata');
    }
    public function gpsDataSets()
    {
        return $this->hasMany('App\Gps');
    }
}
