<?php

namespace App\Http\Controllers\Business\Training\TrainingClass;

use App\Http\Controllers\Controller;
use App\Mail\TrainingInvite;
use App\Models\Business\Booking\Booking;
use App\Models\Business\Company\Company;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Room\Room;
use App\Models\Training;
use App\Models\TrainingClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TrainingClassController extends Controller
{
    public function index()
    {
        $trainingClasss = TrainingClass::with(['training', 'room', 'participants'])->get();

        return view('app.business.training.training_class.training_class_index', compact('trainingClasss'));
    }

    public function create($trainingId)
    {
        $training = Training::where('id', $trainingId)->firstOrFail();

        $instructors = Employee::all();
        $rooms = Room::all();

        $participants = Employee::all();

        $companies = Company::all();

        return view('app.business.training.training_class.training_class_create', compact('training', 'instructors', 'rooms', 'companies', 'participants'));
    }


    public function store(Request $request)
    {
//        dd($request->all());

        // monte as regras normalmente
        $rules = [
            'training_id'                => 'required|exists:trainings,id',
            'capacity'                   => 'required|integer|min:1',
            'groups'                     => 'required|array',
            'groups.*.start_datetime'    => 'required|date',
            'groups.*.end_datetime'      => 'required|date|after:groups.*.start_datetime',
            'groups.*.room_id'           => 'required|exists:rooms,id',
            'groups.*.instructor_id'     => 'required|exists:employees,id',
            'groups.*.participant_ids'   => 'required|array|min:1',
            'groups.*.participant_ids.*' => 'exists:employees,id',
        ];

        // em vez de $request->validate, use o Validator para inspecionar erros
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // aqui você vai ver exatamente quais regras não estão passando
            dd(
                'Requisição:',
                $request->all(),
                'Erros de validação:',
                $validator->errors()->toArray()
            );
        }

        // se caiu aqui, então *todas* as regras passaram
//        dd('passou');

        $errors = [];

        foreach ($request->groups as $i => $g) {
            $start = Carbon::parse($g['start_datetime']);
            $end = Carbon::parse($g['end_datetime']);

            // 1) conflito na bookings?
            $busyRoom = Booking::where('room_id', $g['room_id'])
                ->where(function ($q) use ($start, $end) {
                    $q->whereBetween('start_time', [$start, $end])
                        ->orWhereBetween('end_time', [$start, $end])
                        ->orWhere(function ($q2) use ($start, $end) {
                            $q2->where('start_time', '<', $start)
                                ->where('end_time', '>', $end);
                        });
                })
                ->exists();
            if ($busyRoom) {
                return back()
                    ->withErrors(["groups.$i.room_id" => "Sala ocupada entre {$start->format('H:i')} e {$end->format('H:i')}"])
                    ->withInput();
            }

            // 2) conflito do instrutor?
            $busyInstr = TrainingClass::where('instructor_id', $g['instructor_id'])
                ->where(function ($q) use ($start, $end) {
                    $q->whereBetween('start_date', [$start, $end])
                        ->orWhereBetween('end_date', [$start, $end])
                        ->orWhere(function ($q2) use ($start, $end) {
                            $q2->where('start_date', '<', $start)
                                ->where('end_date', '>', $end);
                        });
                })
                ->exists();
            if ($busyInstr) {
                return back()
                    ->withErrors(["groups.$i.instructor_id" => "Instrutor ocupado entre {$start->format('H:i')} e {$end->format('H:i')}"])
                    ->withInput();
            }
        }


        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        // se tudo ok, cria cada turma + vincula participants
        foreach ($request->groups as $g) {
            $tc = TrainingClass::create([
                'training_id' => $request->training_id,
                'instructor_id' => $g['instructor_id'],
                'room_id' => $g['room_id'],
                'capacity' => $request->capacity,
                'start_date' => Carbon::parse($g['start_datetime'])->toDateString(),
                'end_date' => $end->toDateString()
            ]);

            // pivot participants
            $tc->participants()->attach($g['participant_ids']);
        }

        // depois de criar a TrainingClass…
        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $g['room_id'],
            'title' => "Treinamento #{$tc->id}",
            'start_time' => $start,
            'end_time' => $end,
        ]);


        return redirect()
            ->route('training-class.index')
            ->with('success', 'Turmas criadas com sucesso.');
    }


    // 2) Envio de e-mail via template dinâmico
    public function sendEmail(Request $r, $trainingClassId)
    {
        $tpl = $r->input('template');

        $trainingClass = TrainingClass::with('participants.employeeUser.user')->find($trainingClassId);

        foreach ($trainingClass->participants as $p) {
            $msg = str_replace(
                ['{COLABORADOR}','{TREINAMENTO}','{DATA_TREINAMENTO}'],
                [
                    $p->name,
                    $trainingClass->training->title,
                    Carbon::parse($trainingClass->start_date)
                        ->format('d/m/Y H:i')
                ],
                $tpl
            );

            try {
                Mail::to($p->employeeUser->user->email)
                    ->send(new \App\Mail\TrainingInvite($msg));
            } catch (\Throwable $e) {
                // em vez de esconder, mostre o erro:
                dd("Falha ao enviar para {$p->employeeUser->user->email}", $e->getMessage());
            }
        }



        if (!empty($errors)) {
            return back()
                ->with('error', 'Falha ao enviar para: '.implode(', ', $errors));
        }

        return back()->with('success', 'E‑mails enviados com sucesso.');
    }
}
