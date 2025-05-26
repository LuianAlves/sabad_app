<?php

namespace App\Http\Controllers\Business\Maintenance;

use App\Http\Controllers\Controller;

use App\Http\Requests\Business\Maintenance\StoreMaintenanceRequest;
use App\Http\Requests\Business\Maintenance\UpdateMaintenanceRequest;
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Maintenance\Maintenance;


class MaintenanceController extends Controller
{
    
    public function index()
    {
        $maintenances = Maintenance::get();
        $device_controls = DeviceControl::get();

        return view('app.business.maintenance.maintenance_index', compact('maintenances', 'device_controls'));
    }

    
    public function create()
    {
        $device_controls = DeviceControl::with('device.employee')->get();

        return view( 'app.business.maintenance.maintenance_create', compact('device_controls'));
    }

    
    public function store(StoreMaintenanceRequest $request)
    {
        $request->validated();

        $maintenance = Maintenance::create([
            'device_control_id' => $request->devicecontrol_id,
            'delivered_in' => $request->delivered_in,
            'last_maintenance' => $request->last_maintenance,
            'next_maintenance' => $request->next_maintenance
        ]);

        return redirect()->route('maintenance.index');
    }

    
    public function show($id)
    {
        $maintenance = Maintenance::find($id);

        return view('app.business.maintenance.maintenance_show', compact('maintenance'));
    }

    
    public function edit($id)
    {
        $maintenance = Maintenance::wherw('id', $id)->first();
        $device_controls =DeviceControl::get();

        return view('app.business.maintenance.maintenance_edit', compact('maintenance', 'device_controls'));
    }

    
    public function update(UpdateMaintenanceRequest $request, $id)
    {
        $request->validated();

        $maintenance = Maintenance::find($id);

        $maintenance->update([
            'device_control_id' => $request->devicecontrol_id,
            'delivered_in' => $request->delivered_in,
            'last_maintenance' => $request->last_maintenance,
            'next_maintenance' => $request->next_maintenance
        ]);

        return redirect()->route('maintenance.index');
    }

    
    public function destroy($id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->delete($id);

        return redirect()->route('maintenance.index');
    }
}
