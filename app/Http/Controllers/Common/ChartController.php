<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Business\Department\Department;

class ChartController extends Controller
{
    public function employeePerDepartment(Request $request)
    {
        $query = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'departments.name as name',
                DB::raw("SUM(CASE WHEN employees.status = 1 THEN 1 ELSE 0 END) as active"),
                DB::raw("SUM(CASE WHEN employees.status = 0 THEN 1 ELSE 0 END) as inactive"),
                DB::raw("COUNT(employees.id) as total")
            );

        if ($request->has('company_id') && $request->company_id !== 'all') {
            $query->where('departments.company_id', $request->company_id);
        }

        $query->groupBy('departments.name');

        $results = $query->get();

        return response()->json([
            'employee' => $results->pluck('name'),
            'number' => $results->pluck('total'),
            'actives' => $results->pluck('active'),
            'inactives' => $results->pluck('inactive')
        ]);
    }
}
