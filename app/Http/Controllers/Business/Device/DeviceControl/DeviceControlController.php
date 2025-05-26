<?php

namespace App\Http\Controllers\Business\Device\DeviceControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Business\Device\DeviceContro\StoreDeviceControlRequest;

// Models
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Device\Device;
use App\Models\Business\Employee\Employee;

// Dependences
use Carbon\Carbon;

class DeviceControlController extends Controller
{
    public function index()
    {
        return view('app.business.device.device_control.device_control_index');
    }

    public function create()
    {
        $devices = Device::all();
        $employees = Employee::all();

        return view('app.business.device.device_control.device_control_create', compact('devices','employees'));
    }

    public function store(StoreDeviceControlRequest $request)
    {
        $request->validated();

        $deviceControl = DeviceControl::create([
            'device_id' => $request->device_id,
            'employee_id' => $request->employee_id,
            'device_code' => $request->device_code,
            'delivered_in' => $request->delivered_in,
            'returned_in' => $request->returned_in,
            'estimated_price' => $request->estimated_price,
            'purchased_in' => $request->purchased_in,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('device_control.index');
    }
}
