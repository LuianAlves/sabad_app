<?php

namespace App\Http\Controllers\Business\Chip\PhoneOperator;

use App\Models\Business\Chip\PhoneOperator\PhoneOperator;
use App\Http\Requests\Business\Chip\PhoneOperator\StorePhoneOperatorRequest;
use App\Http\Requests\Business\Chip\PhoneOperator\UpdatePhoneOperatorRequest;
use App\Http\Controllers\Controller;

class PhoneOperatorController extends Controller
{
    
    public function index()
    {
        $operators = PhoneOperator::get();

        return view('app.business.chip.phone_operator.phone_operator_index', compact('operators'));
    }

    
    public function create()
    {
        $operator = PhoneOperator::get();

        return view('app.business.chip.phone_operator.phone_operator_create', compact('operator'));
    }

    
    public function store(StorePhoneOperatorRequest $request)
    {
        $request->validated();

        $operator = PhoneOperator::create([
            'name' => $request->name
        ]);

        return redirect()->route('operator.index');
    }

    
    public function show($id)
    {
        $operator = PhoneOperator::find($id);

        return view('app.businesschip.phoneoperator.phone_operator_show', compact('operator')); 
    }

    
    public function edit($id)
    {
        $operator = PhoneOperator::where('id', $id)->first();

        return view('app.business.phoneoperator.phoneoperator_edit', compact('operator'));
    }

    
    public function update(UpdatePhoneOperatorRequest $request, $id)
    {
        $request->validated();

        $operator = PhoneOperator::findOrFail($id);

        $operator->update([
            'name' => $request->name
        ]);

        return redirect()->route('operator.index');
    }

    
    public function destroy($id)
    {
        $operator = PhoneOperator::find($id);
        $operator->delete();

        return redirect()->route('operator.index');
    }
}
