<?php

namespace App\Http\Controllers\Business\Device\DeviceModel;

use App\Http\Controllers\Controller;

// Requests 
use Illuminate\Http\Request;
use App\Http\Requests\Business\Device\DeviceModel\StoreDeviceModelRequest;
use App\Http\Requests\Business\Device\DeviceModel\UpdateDeviceModelRequest;

// Models
use App\Models\Business\Device\DeviceModel\DeviceModel;

// Dependences
use Carbon\Carbon;

class DeviceModelController extends Controller
{
    public function index()
    {
        $deviceModels = DeviceModel::with('deviceBrand')->get();

        return view('app.business.device.device_model.device_model_index', compact('deviceModels'));
    }


    public function create()
    {
        return view('app.business.device.device_model.device_model_create');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function store(StoreDeviceModelRequest $request)
    {
        $request->validated();

        $deviceModel = DeviceModel::create([
            'device_brand_id' => $request->device_brand_id,
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($deviceModel);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    /* END: CRUD */

    public function search(Request $request)
    {
        $query = $request->input('q');
        $brandId = $request->input('device_brand_id');

        $deviceModels = DeviceModel::where('device_brand_id', $brandId)
            ->where('name', 'like', '%' . $query . '%')
            ->get();

        return response()->json($deviceModels);
    }
}
