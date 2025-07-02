<?php

namespace App\Http\Controllers\Business\Device\DeviceType;

use App\Http\Controllers\Controller;

// Requests 
use Illuminate\Http\Request;
use App\Http\Requests\Business\Device\DeviceType\StoreDeviceTypeRequest;
use App\Http\Requests\Business\Device\DeviceType\UpdateDeviceTypeRequest;

// Models
use App\Models\Business\Device\DeviceType\DeviceType;

// Dependences
use Carbon\Carbon;

class DeviceTypeController extends Controller
{
    public function index()
    {
        $deviceTypes = DeviceType::get();

        return view('app.business.device.device_type.device_type_index', compact('deviceTypes'));
    }

    public function create()
    {
        return view('app.business.device.device_type.device_type_create');
    }

    public function store(StoreDeviceTypeRequest $request)
    {
        $request->validated();

        $deviceType = DeviceType::create([
            'name'       => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($deviceType);
    }

    public function edit($id)
    {
        $deviceType = DeviceType::find($id);

        return view('app.business.device.device_type.device_type_edit', compact('deviceType'));
    }

    public function update(UpdateDeviceTypeRequest $request, $id)
    {
        $request->validated();

        DeviceType::find($id)->update([
            'name'       => $request->name,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('device_type.index');
    }

    public function destroy($id)
    {
        $deviceType = DeviceType::find($id);
        $deviceType->delete();

        return redirect()->route('device_type.index');
    }

    /* END: CRUD */

    public function search(Request $request)
    {
        $query = $request->input('q');

        $deviceTypes = DeviceType::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($deviceTypes);
    }
}
