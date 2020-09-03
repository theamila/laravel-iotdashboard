<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Gps;
use App\Http\Controllers\Controller;
use App\Iotdata;
use Illuminate\Http\Request;

class GpsController extends Controller
{
    public function store(Request $request)
    {
        // Validate
        // Check rights
        // return response()->json(isset($request->lat));
        $device = Device::where('name', $request->device)->first();
        // return response()->json($request);

        $gpsData = new Gps();
        if ($request->api_key == $device->api_key) {
            if (isset($request->lat) && isset($request->lon)) {
                $gpsData->device_id = $device->id;
                $gpsData->timestamp = $request->timestamp;
                $gpsData->lat = $request->lat;
                $gpsData->lon = $request->lon;
                $gpsData->alt = $request->alt;
                $gpsData->save();
            }
        }
        return response()->json(['success' =>  $gpsData]);
    }
}
