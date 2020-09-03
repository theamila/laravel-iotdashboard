<?php

namespace App\Http\Controllers\Admin;

use App\Device;
use App\Gps;
use App\Http\Controllers\Controller;
use App\Iotdata;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('admin.dashboard.index', compact('devices'));
    }
    public function showDataTable($id)
    {
        $iotData = Iotdata::where('device_id', $id)->get();
        debugbar()->info($iotData);

        return view('admin.dashboard.datatable', compact('iotData'));
    }
    public function showGpsTable($id)
    {
        $gpsData = Gps::where('device_id', $id)->get();
        debugbar()->info($gpsData);
        return view('admin.dashboard.gpstable', compact('gpsData'));
    }

    public function showDashboard($id)
    {
        $iotData = Iotdata::where('device_id', $id)->get();
        $gpsData = Gps::where('device_id', $id)->get();
        return view('admin.dashboard.dashboard', compact('iotData', 'gpsData'));
    }
}
