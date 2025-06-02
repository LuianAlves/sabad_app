<?php

namespace App\Http\Controllers\Business\Heritage;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Business\Heritage\StoreHeritageRequest;
use App\Http\Requests\Business\Heritage\UpdateHeritageRequest;

// Models
use App\Models\Business\Heritage\Heritage;

// Dependences
use Carbon\Carbon;

class HeritageController extends Controller
{
    public function index()
    {
        $heritages = Heritage::get();

        return view('app.business.heritage.heritage_index', compact('heritages'));
    }

    public function create()
    {
        return view('app.business.heritage.heritage_create');
    }

    public function store(StoreHeritageRequest $request)
    {
        $request->validated();

        $heritage = Heritage::create([
            'heritage_type_id' => $request->heritage_type_id,
            'heritage_brand_id' => $request->heritage_brand_id,
            'heritage_model_id' => $request->heritage_model_id,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('heritage.index');
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
}
