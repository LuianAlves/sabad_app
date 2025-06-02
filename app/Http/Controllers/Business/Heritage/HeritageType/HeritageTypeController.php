<?php

namespace App\Http\Controllers\Business\Heritage\HeritageType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Business\Heritage\HeritageType\StoreHeritageTypeRequest;
use App\Http\Requests\Business\Heritage\HeritageType\UpdateHeritageTypeRequest;

// Models
use App\Models\Business\Heritage\HeritageType\HeritageType;

// Dependences
use Carbon\Carbon;

class HeritageTypeController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreHeritageTypeRequest $request)
    {
        $request->validated();

        $heritageType = HeritageType::create([
            'name'       => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($heritageType);
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

        $heritageTypes = HeritageType::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($heritageTypes);
    }
}
