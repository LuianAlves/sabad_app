<?php

namespace App\Http\Controllers\Business\Maintenance;

use App\Http\Controllers\Controller;

use App\Http\Requests\Business\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Business\Maintenance\UpdateMaintenanceRequest;
use App\Models\Business\Device\Device;
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Maintenance\Maintenance;
use Carbon\Carbon;


class MaintenanceController extends Controller
{
    
    public function index()
    {
        $maintenances = Maintenance::with('deviceControl.device.deviceType', 'deviceControl.employee')->get();       
        $nextMaintenance = $maintenances
        ->filter(fn ($m) => Carbon::parse($m->next_maintenance)->greaterThanOrEqualTo(Carbon::today()));

    

        return view('app.business.maintenance.maintenance_index', compact('maintenances', 'nextMaintenance'));
    }

    
    public function create()
    {
        $deviceControls = DeviceControl::with('employee', 'device.deviceType', 'device.deviceBrand')->get();

        return view( 'app.business.maintenance.maintenance_create', compact('deviceControls'));
    }

    
    public function store(StoreMaintenanceRequest $request)
    {
        $request->validated();

        $maintenance = Maintenance::create([
            'device_control_id' => $request->device_control_id,
            'delivered_in' => $request->delivered_in,
            'last_maintenance' => $request->last_maintenance,
            'next_maintenance' => $request->next_maintenance
        ]);

        return redirect()->route('maintenance.index');
    }

    
    public function show($id)
    {
        $maintenance = Maintenance::with('deviceControl.device.deviceType', 'deviceControl.employee')->find($id);

        return view('app.business.maintenance.maintenance_show', compact('maintenance'));
    }

    
    public function edit($id)
    {
        $maintenance = Maintenance::where('id', $id)->first();
        $device_controls =DeviceControl::with('employee')->get();

        return view('app.business.maintenance.maintenance_edit', compact('maintenance', 'device_controls'));
    }

    
    public function update(UpdateMaintenanceRequest $request, $id)
    {
        $request->validated();

        $maintenance = Maintenance::find($id);

        $maintenance->update([
            'device_control_id' => $request->device_control_id,
            'delivered_in' => $request->delivered_in,
            'last_maintenance' => $request->last_maintenance,
            'next_maintenance' => $request->next_maintenance
        ]);

        return redirect()->route('maintenance.index');
    }

    
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->delete();

        return redirect()->route('maintenance.index');
    }
}
