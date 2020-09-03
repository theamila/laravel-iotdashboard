<?php

namespace App\Http\Controllers\Admin;

use App\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('admin.device.index', compact('devices'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255']);
        $device = new Device();
        $device->name = $request->name;
        $device->api_key = Str::random(32);
        $device->save();
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|max:255', 'api_key' => 'required|max:255']);
        $device = Device::findOrFail($id);
        $device->name = $request->name;
        $device->api_key = $request->api_key;
        $device->save();
        return redirect()->back();
    }
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();
        return redirect()->back();
    }
    public function changeApiKey()
    {
    }
}
