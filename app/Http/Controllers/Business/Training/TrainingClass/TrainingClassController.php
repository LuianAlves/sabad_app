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

        $instructors  = Employee::all();
        $rooms        = Room::all();
        $participants = Employee::all();
        $companies    = Company::all();

        return view(
            'app.business.training.training_class.training_class_create',
            compact('training', 'instructors', 'rooms', 'companies', 'participants')
        );
    }

    public function store(Request $request)
    {
        $rules = [
            'training_id'                => 'required|exists:trainings,id',
            'capacity'                   => 'required|integer|min:1',
            'groups'                     => 'required|array|min:1',
            'groups.*.start_datetime'    => 'required|date',
            'groups.*.end_datetime'      => 'required|date|after:groups.*.start_datetime',
            'groups.*.room_id'           => 'required|exists:rooms,id',
            'groups.*.instructor_id'     => 'required|exists:employees,id',
            'groups.*.participant_ids'   => 'required|array|min:1',
            'groups.*.participant_ids.*' => 'exists:employees,id',
        ];

        $messages = [
            'groups.required' => 'Adicione pelo menos 1 turma/horário.',
            'groups.array'    => 'Formato inválido nos grupos.',
            'groups.min'      => 'Adicione pelo menos 1 turma/horário.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // garante que é array (evita foreach em null em qualquer cenário)
        $groups = (array) $request->input('groups', []);

        // 1) valida conflitos antes de gravar
        foreach ($groups as $i => $g) {
            $start = Carbon::parse($g['start_datetime']);
            $end   = Carbon::parse($g['end_datetime']);

            // conflito na sala (bookings)
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

            // conflito do instrutor (TrainingClass)
            $busyInstr = TrainingClass::where('instructor_id', $g['instructor_id'])
                ->where(function ($q) use ($start, $end) {
                    $q->whereBetween('start_date', [$start->toDateString(), $end->toDateString()])
                        ->orWhereBetween('end_date', [$start->toDateString(), $end->toDateString()])
                        ->orWhere(function ($q2) use ($start, $end) {
                            $q2->where('start_date', '<', $start->toDateString())
                                ->where('end_date', '>', $end->toDateString());
                        });
                })
                ->exists();

            if ($busyInstr) {
                return back()
                    ->withErrors(["groups.$i.instructor_id" => "Instrutor ocupado entre {$start->format('H:i')} e {$end->format('H:i')}"])
                    ->withInput();
            }
        }

        // 2) grava turmas + participants + booking por grupo
        foreach ($groups as $g) {
            $start = Carbon::parse($g['start_datetime']);
            $end   = Carbon::parse($g['end_datetime']);

            $tc = TrainingClass::create([
                'training_id'   => $request->training_id,
                'instructor_id' => $g['instructor_id'],
                'room_id'       => $g['room_id'],
                'capacity'      => $request->capacity,
                'start_date'    => $start->toDateString(),
                'end_date'      => $end->toDateString(),
            ]);

            $tc->participants()->attach($g['participant_ids']);

            Booking::create([
                'user_id'    => auth()->id(),
                'room_id'    => $g['room_id'],
                'title'      => "Treinamento #{$tc->id}",
                'start_time' => $start,
                'end_time'   => $end,
            ]);
        }

        return redirect()
            ->route('training-class.index')
            ->with('success', 'Turmas criadas com sucesso.');
    }

    public function sendEmail(Request $r, $trainingClassId)
    {
        $tpl = (string) $r->input('template', '');

        $trainingClass = TrainingClass::with(['training', 'participants.employeeUser.user'])
            ->findOrFail($trainingClassId);

        $errors = [];

        foreach ($trainingClass->participants as $p) {
            $email = optional(optional($p->employeeUser)->user)->email;

            if (!$email) {
                $errors[] = $p->name . ' (sem e-mail)';
                continue;
            }

            $msg = str_replace(
                ['{COLABORADOR}', '{TREINAMENTO}', '{DATA_TREINAMENTO}'],
                [
                    $p->name,
                    optional($trainingClass->training)->title,
                    Carbon::parse($trainingClass->start_date)->format('d/m/Y'),
                ],
                $tpl
            );

            try {
                Mail::to($email)->send(new TrainingInvite($msg));
            } catch (\Throwable $e) {
                $errors[] = $email . ' - ' . $e->getMessage();
            }
        }

        if (!empty($errors)) {
            return back()->with('error', 'Falha ao enviar para: ' . implode(' | ', $errors));
        }

        return back()->with('success', 'E-mails enviados com sucesso.');
    }
}
