<?php

namespace App\Http\Controllers\Business\Training\TrainingClass;

use App\Http\Controllers\Controller;
use App\Mail\TrainingInvite;
use App\Models\Business\Company\Company;
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
        $trainingClasss = TrainingClass::with(['training', 'room', 'participants'])->get();

        return view('app.business.training.training_class.training_class_index', compact('trainingClasss'));
    }

    public function create($trainingId)
    {
        $training   = Training::where('id', $trainingId)->firstOrFail();

        $instructors = Employee::all();
        $rooms = Room::all();

        $participants = Employee::all();

        $companies = Company::all();

        return view('app.business.training.training_class.training_class_create', compact('training','instructors', 'rooms', 'companies', 'participants'));
    }


    public function store(Request $r)
    {
        $r->validate([
            'training_id'   => 'required|exists:trainings,id',
            'room_id' => 'required|exists:rooms,id',
            'capacity'      => 'required|integer|min:1',
            'start_date'    => 'required|date',
        ]);

        dd($r->all());

        $training = TrainingClass::create([
            'training_id' => $r->training_id,
            'room_id' => $r->room_id,
            'instructor_id' => $r->instructor_id,
            'external_instructor_name' => $r->external_instructor_name,
            'external_instructor_email' => $r->external_instructor_email,
            'capacity' => $r->capacity,
            'start_date' => $r->start_date,
            'end_date' => $r->end_date
        ]);

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
