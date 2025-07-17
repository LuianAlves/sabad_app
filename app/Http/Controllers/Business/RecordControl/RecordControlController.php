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

    public function index(Department $department)
    {
        $records = RecordControl::where('department_id', $department->id)->with('employee')->get();
        return view('app.business.record_control.record_controls_index', compact('records', 'department'));
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
}
