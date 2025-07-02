<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;

use App\Models\Business\Employee\Employee;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $limitDate = Carbon::now()->subDays(90);

        $recentEmployees = Employee::with('department')->where('hired_in', '>=', $limitDate)->orderBy('hired_in', 'desc')->get();

        $recentEmployees->each(function ($employee) {
            $employee->hired_in = Carbon::parse($employee->hired_in)->diffForhumans();
        });

        return view("app.dashboard", compact(
            "recentEmployees"
        ));
    }
}
