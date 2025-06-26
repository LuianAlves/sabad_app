<?php

namespace App\Http\Controllers\Business\Chip\ChipControl;

use App\Models\Business\Chip\ChipControl\ChipControl;
use App\Http\Requests\Business\Chip\ChipControl\StoreChipControlRequest;
use App\Http\Requests\Business\Chip\ChipControl\UpdateChipControlRequest;
use App\Models\Business\Chip\Chip;
use App\Models\Business\Employee\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChipControlController extends Controller
{
    
    public function index()
    {
        $chipControls = ChipControl::with('chip', 'employee')->get();

        return view('app.business.chip.chip_control.chip_control_index', compact('chipControls'));
    }


    public function create()
    {
        $chips = Chip::with('company', 'phone_operator')->get();
        $employees = Employee::with('department.company')->get();

        return view('app.business.chip.chip_control.chip_control_create', compact('chips', 'employees'));
    }

    
    public function store(StoreChipControlRequest $request)
    {
        $request->validated();

        $chipControl = ChipControl::create([
            'chip_id' => $request->chip_id,
            'employee_id' => $request->employee_id,
            'ddd'=> $request->ddd,
            'number' => $request->number,
            'delivered_in' => $request->delivered_in,
            'returned_in' => $request->returned_in
        ]);

        return redirect()->route('chipcontrol.index');
    }

    
    public function show($id)
    {
        $chipControl = ChipControl::find($id);

        return view('app.business.chip.chipcontrol.chip_control_show', compact('chipControl'));
    }


    public function edit($id)
    {
        $chipControl = ChipControl::where('id', $id)->first();

        return view('app.business.chipcontrol.chip_control_edit', compact('chipControl'));
    }

    
    public function update(UpdateChipControlRequest $request, $id)
    {
        $request->validated();

        $chipControl = ChipControl::find($id);

        $chipControl->update([
            'chip_id' => $request->chip_id,
            'employee_id' => $request->employee_id,
            'ddd'=> $request->ddd,
            'number' => $request->number,
            'delivered_in' => $request->delivered_in,
            'returned_in' => $request->returned_in
        ]);

        return redirect()->route('chipcontrol.index');
    }

    
    public function destroy($id)
    {
        $chipControl = ChipControl::find($id);
        $chipControl->delete();

        return redirect()->route('chipcontrol.index');
    }
}
