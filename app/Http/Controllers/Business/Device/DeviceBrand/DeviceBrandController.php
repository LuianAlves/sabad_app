<?php

namespace App\Http\Controllers\Business\Device\DeviceBrand;

use App\Http\Controllers\Controller;

// Requests 
use Illuminate\Http\Request;
use App\Http\Requests\Business\Device\DeviceBrand\StoreDeviceBrandRequest;

// Models
use App\Models\Business\Device\DeviceBrand\DeviceBrand;

// Dependences
use Carbon\Carbon;

class DeviceBrandController extends Controller
{
    public function index()
    {
        $deviceBrands = DeviceBrand::get();
    }

    public function create()
    {
        //
    }

    public function store(StoreDeviceBrandRequest $request)
    {
        $request->validated();

        $deviceBrand = DeviceBrand::create([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($deviceBrand);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
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

        $deviceBrands = DeviceBrand::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($deviceBrands);
    }
}
