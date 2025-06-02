<?php

namespace App\Http\Controllers\Business\Heritage\HeritageBrand;

use App\Http\Controllers\Controller;

// Requests 
use Illuminate\Http\Request;
use App\Http\Requests\Business\Heritage\HeritageBrand\StoreHeritageBrandRequest;

// Models
use App\Models\Business\Heritage\HeritageBrand\HeritageBrand;

// Dependences
use Carbon\Carbon;

class HeritageBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(StoreHeritageBrandRequest $request)
    {
        $request->validated();

        $heritageBrand = HeritageBrand::create([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        return response()->json($heritageBrand);
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

        $heritageBrands = HeritageBrand::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($heritageBrands);
    }
}
