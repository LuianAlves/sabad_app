<?php

namespace App\Http\Controllers\Business\Chip;

use App\Models\Business\Chip\Chip;
use App\Http\Requests\Business\Chip\StoreChipRequest;
use App\Http\Requests\Business\Chip\UpdateChipRequest;
use App\Http\Controllers\Controller;
use App\Models\Business\Company\Company;
use App\Models\Business\Chip\PhoneOperator\PhoneOperator;

class ChipController extends Controller
{
    
    public function index()
    {
        $chips = Chip::with('company', 'phone_operator')->get();

        return view('app.business.chip.chip_index', compact('chips'));
    }

    
    public function create()
    {
        $companies = Company::get();
        $operators = PhoneOperator::get();

        return view('app.business.chip.chip_create', compact('companies', 'operators'));
    }

   
    public function store(StoreChipRequest $request)
    {
        $request->validated();

        $chip = Chip::create([
            'company_id' => $request->company_id,
            'phone_operator_id' => $request->phone_operator_id
        ]);

        return redirect()->route('chip.index');
    }

    
    public function show($id)
    {
        $chip = Chip::findOrFail($id);

        return view('app.business.chip.chip_show', compact('chip'));
    }

    
    public function edit($id)
    {
        $chip = Chip::where('id', $id)->first();

        return view('app.business.chip.chip_edit', compact('chip'));
    }

    
    public function update(UpdateChipRequest $request, $id)
    {
        $request->validated();

        $chip = Chip::find($id);

        $chip->update([
            'company_id' => $request->company_id,
            'phone_operator_id' => $request->phone_operator_id
        ]);

        return redirect()->route('chip.index');

    }

    
    public function destroy($id)
    {
        $chip = Chip::find($id);
        $chip->delete();

        return redirect()->route('chip.index');
    }
}
