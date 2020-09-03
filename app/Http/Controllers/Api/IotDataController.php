<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Gps;
use App\Http\Controllers\Controller;
use App\Iotdata;
use Illuminate\Http\Request;

class IotDataController extends Controller
{
    public function index()
    {
        $dataSets = Iotdata::all();
        return response($dataSets)->json();
    }
    public function store(Request $request)
    {
        // Validate
        // Check rights
        // return response()->json(isset($request->lat));
        $device = Device::where('name', $request->device)->first();
        // return response()->json($request);
        $iotData = new Iotdata();
        $gpsData = new Gps();
        if ($request->api_key == $device->api_key) {
            $iotData->device_id = $device->id;
            $iotData->pm2_5 = $request->pm2_5;
            $iotData->pm10 = $request->pm10;
            $iotData->temp = $request->temp;
            $iotData->hum = $request->hum;
            $iotData->pressure = $request->pressure;
            $iotData->sealevel = $request->sealevel;
            $iotData->save();
            if (isset($request->lat) && isset($request->lon)) {
                $gpsData->device_id = $device->id;
                $gpsData->timestamp = $request->timestamp;
                $gpsData->lat = $request->lat;
                $gpsData->lon = $request->lon;
                $gpsData->alt = $request->alt;
                $gpsData->save();
            }
        }
        return response()->json(['success' => ['data' => $iotData, 'gps' => $gpsData]]);
    }
}
