<?php

namespace App\Http\Controllers\Business\RecordControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordControlRequest;
use App\Http\Requests\UpdateRecordControlRequest;
use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use App\Models\RecordControl;
use Illuminate\Support\Facades\Request;


class RecordControlController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $employee = $user->employeeUser->employee ?? null;
        $department = $employee->department ?? null;

        if (!$department) {
            abort(403, 'Usuário não está vinculado a nenhum departamento.');
        }

        // Buscar registros só do departamento do usuário, com os relacionamentos
        $records = RecordControl::where('department_id', $department->id)
            ->with('employee.department.company')
            ->get();

        // Agrupar por empresa e departamento (vai ser só um departamento, mas fica organizado)
        $grouped = $records->groupBy(function ($item) {
            return $item->employee->department->company->name ?? 'Sem Empresa';
        })->map(function ($companyGroup) {
            return $companyGroup->groupBy(function ($item) {
                return $item->employee->department->name ?? 'Sem Departamento';
            });
        });

        return view('app.business.record_control.record_controls_index', compact('grouped', 'department','records'));
    }



    public function create(Department $department)
    {
        $employees = Employee::where('department_id', $department->id)->get();
        return view('app.business.record_control.record_controls_create', compact('department', 'employees'));
    }

    public function store(StoreRecordControlRequest $request,  Department $department)
    {
        $request->validated();

        $recordcontrol = RecordControl::create([

            'department_id' => $request->department_id,
            'employee_id' => $request->employee_id,
            'identificacao' => $request->identificacao,
            'forma_armazenamento' => $request->forma_armazenamento,
            'local_armazenamento' => $request->local_armazenamento,
            'acesso_permitido' => $request->acesso_permitido,
            'tempo_retencao' => $request->tempo_retencao,
            'metodo_manutencao' => $request->metodo_manutencao,
        ]);

        return redirect()->route('record_controls.index', $department)->with('success', 'Registro adicionado.');
    }

    public function show($id)
    {
        $recordcontrol = RecordControl::find($id);

        return view('app.business.record_control.record_controls_show', compact('recordcontrol'));
    }

}
