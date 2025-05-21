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
            ->select('departments.name as name', DB::raw('count(employees.id) as number'));

        // Se vier o filtro por company_id e não for 'all', aplica
        if ($request->has('company_id') && $request->company_id !== 'all') {
            $query->where('departments.company_id', $request->company_id);
        }

        $query->groupBy('departments.name');

        $results = $query->get();

        return response()->json([
            'employee' => $results->pluck('name'),
            'number' => $results->pluck('number'),
        ]);
    }
}
