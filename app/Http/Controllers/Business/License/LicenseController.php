<?php

namespace App\Http\Controllers\Business\License;

use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Business\License\StoreLicenseRequest;
use App\Http\Requests\Business\License\UpdateLicenseRequest;

// Models
use App\Models\Business\License\License;
use App\Models\Business\Service\Service;

// Dependences
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = License::get();

        return view('app.business.license.license_index', compact('licenses'));
    }

    public function create()
    {
        $services = Service::get();

        return view('app.business.license.license_create', compact('services'));
    }

    public function store(StoreLicenseRequest $request)
    {
        $request->validated();

        $password = $request->input('password');
        $cryptedPassword = Crypt::encrypt($password);   

        $service = License::create([
            'service_id' => $request->service_id,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $cryptedPassword,
            'contracted_in' => $request->contracted_in,
            'price_per_unit' => $request->price_per_unit,
            'recurrence' => $request->recurrence,
            'payment_day' => $request->payment_day,
            'is_active' => (bool) $request->is_active,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('license.index');
    }

    public function show($id)
    {
        $license = License::with('service')->findOrFail($id);
        
        return view('app.business.license.license_show', compact('license'));        
    }

    public function edit($id)
    {
        $license = License::findOrFail($id);
        $services = Service::get();

        return view('app.business.license.license_edit', compact('license', 'services'));
    }

    public function update(UpdateLicenseRequest $request, $id)
    {
        $request->validated();

        $license = License::findOrFail($id);

        $password = $request->input('password');
        $cryptedPassword = Crypt::encrypt($password);   

        $license->update([
            'service_id' => $request->service_id,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'user' => $request->user,
            'email' => $request->email,
            'password' => $cryptedPassword,
            'contracted_in' => $request->contracted_in,
            'price_per_unit' => $request->price_per_unit,
            'recurrence' => $request->recurrence,
            'payment_day' => $request->payment_day,
            'is_active' => (bool) $request->is_active,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('license.index');
    }

    public function destroy($id)
    {
        $license = License::findOrFail($id);
        $license->delete();

        return redirect()->route('license.index');
    }
}
