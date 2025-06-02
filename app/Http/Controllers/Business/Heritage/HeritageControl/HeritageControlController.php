<?php

namespace App\Http\Controllers\Business\Heritage\HeritageControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests 
use App\Http\Requests\Business\Heritage\HeritageControl\StoreHeritageControlRequest;
use App\Models\Business\Heritage\Heritage;

// Models
use App\Models\Business\Heritage\HeritageControl\HeritageControl;
use App\Models\Business\Department\Department;

// Dependences
use Carbon\Carbon;

class HeritageControlController extends Controller
{
    public function index()
    {
        $heritageControls = HeritageControl::all();

        return view('app.business.heritage.heritage_control.heritage_control_index', compact('heritageControls'));
    }
    public function create()
    {
        $heritages = Heritage::all();
        $departments = Department::all();

        return view('app.business.heritage.heritage_control.heritage_control_create', compact('heritages', 'departments'));
    }

    public function store(StoreHeritageControlRequest $request)
    {
        $request->validated();

        $heritage = Heritage::findOrFail($request->heritage_id);

        $prefix = strtoupper(substr($heritage->heritageType->name, 0, 4));

        $lastCode = HeritageControl::where('heritage_code', 'like', $prefix . '%')
            ->orderBy('heritage_code', 'desc')
            ->first();

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode->heritage_code, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $heritageCode = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        HeritageControl::create([
            'heritage_id' => $request->heritage_id,
            'department_id' => $request->department_id,
            'heritage_code' => $heritageCode,
            'delivered_in' => $request->delivered_in,
            'returned_in' => $request->returned_in,
            'estimated_price' => $request->estimated_price,
            'purchased_in' => $request->purchased_in,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('heritage_control.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
