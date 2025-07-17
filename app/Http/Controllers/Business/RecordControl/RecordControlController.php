<?php

namespace App\Http\Controllers\Business\RecordControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordControlRequest;
use App\Http\Requests\UpdateRecordControlRequest;
use App\Models\Business\Department\Department;
use App\Models\RecordControl;
use Illuminate\Support\Facades\Request;

class RecordControlController extends Controller
{

    public function index(Department $department)
    {
        $records = RecordControl::where('department_id', $department->id)->with('employee')->get();
        return view('app.business.record_control.record_controls.index', compact('records', 'department'));
    }

    public function create(Department $department)
    {
        $employees = Employee::where('department_id', $department->id)->get();
        return view('record_controls.create', compact('department', 'employees'));
    }

    public function store(Request $request, Department $department)
    {
        $request->validate([
            'employee_id' => 'required',
            'identificacao' => 'required',
            'forma_armazenamento' => 'required',
            'local_armazenamento' => 'required',
            'acesso_permitido' => 'required',
            'tempo_retencao' => 'required',
            'metodo_manutencao' => 'required',
        ]);

        RecordControl::create([
            'department_id' => $department->id,
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
