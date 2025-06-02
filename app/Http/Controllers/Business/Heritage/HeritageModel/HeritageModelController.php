<?php

namespace App\Http\Controllers\Business\Heritage\HeritageModel;

use App\Http\Controllers\Controller;

// Requests 
use Illuminate\Http\Request;
use App\Http\Requests\Business\Heritage\HeritageModel\StoreHeritageModelRequest;
use App\Http\Requests\Business\Heritage\HeritageModel\UpdateHeritageModelRequest;

// Models
use App\Models\Business\Heritage\HeritageModel\HeritageModel;

// Dependences
use Carbon\Carbon;

class HeritageModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreHeritageModelRequest $request)
    {
        $request->validated();

        $heritageModel = HeritageModel::create([
            'heritage_brand_id' => $request->heritage_brand_id,
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($heritageModel);
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

    
    /* END: CRUD */

    public function search(Request $request)
    {
        $query = $request->input('q');
        $brandId = $request->input('heritage_brand_id');

        $heritageModels = HeritageModel::where('heritage_brand_id', $brandId)
            ->where('name', 'like', '%' . $query . '%')
            ->get();

        return response()->json($heritageModels);
    }
}