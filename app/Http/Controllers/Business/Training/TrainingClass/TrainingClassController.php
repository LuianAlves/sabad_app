<?php

namespace App\Http\Controllers\Business\Training\TrainingClass;

use App\Http\Controllers\Controller;
use App\Mail\TrainingInvite;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Room\Room;
use App\Models\Business\Training\Training;
use App\Models\Business\Training\TrainingClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TrainingClassController extends Controller
{
    public function index()
    {
        $turmas = Turma::with(['training', 'instructor', 'participants'])->get();
        return view('turmas.index', compact('turmas'));
    }

    public function create()
    {
        $trainings   = Training::all();
        $instructors = Employee::all();
        $meetClasses = Room::all();

        return view('turmas.create', compact('trainings','instructors','meetClasses'));
    }


    public function store(Request $r)
    {
        $r->validate([
            'training_id'   => 'required|exists:trainings,id',
            'room_id' => 'required|exists:rooms,id',
            'capacity'      => 'required|integer|min:1',
            'start_date'    => 'required|date',
        ]);

        TrainingClass::create($r->only([
            'training_id',
            'room_id',
            'instructor_id',
            'external_instructor_name',
            'external_instructor_email',
            'capacity',
            'start_date',
            'end_date'
        ]));

        return back()->with('success','Turma criada.');
    }

    public function randomizeParticipants(TrainingClass $trainingClass)
    {
        $need = $trainingClass->capacity - $trainingClass->participants()->count();
        $cands = Employee::where('business_id', $trainingClass->training->business_id)
            ->whereNotIn('id', $trainingClass->participants->pluck('id'))
            ->inRandomOrder()->get();

        $selected = collect();
        // garante pelo menos 1 por departamento
        foreach ($cands as $c) {
            if ($selected->count() >= $trainingClass->capacity) break;
            if (!$selected->where('department_id', $c->department_id)->count()) {
                $selected->push($c);
            }
        }
        // preenche o resto aleatoriamente
        if ($selected->count() < $trainingClass->capacity) {
            $extra = $cands->diff($selected)->take($trainingClass->capacity - $selected->count());
            $selected = $selected->merge($extra);
        }
        $trainingClass->participants()->sync($selected->pluck('id'));
        return back()->with('success', 'Participantes sorteados.');
    }

    // 2) Envio de e-mail via template dinâmico
    public function sendEmail(Request $r, TrainingClass $trainingClass)
    {
        $tpl = $r->input('template');
        foreach ($trainingClass->participants as $p) {
            $msg = str_replace(
                ['{COLABORADOR}', '{TREINAMENTO}', '{DATA_TREINAMENTO}'],
                [$p->name, $trainingClass->training->title,
                    \Carbon\Carbon::parse($trainingClass->start_date)->format('d/m/Y')],
                $tpl
            );

            Mail::to($p->user->email)->queue(new TrainingInvite($msg));
        }
        return back()->with('success', 'E-mails enviados.');
    }
}
