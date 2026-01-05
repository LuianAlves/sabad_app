<?php

namespace App\Http\Controllers\Business\Booking;

use App\Http\Controllers\Controller;
use App\Models\Business\Booking\Booking;
use App\Models\Business\Room\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['bookings.user.company' => function ($query) {
            $query->latest('start_time');
        }])->get();

        return view('app.business.booking.bookings_index', compact('rooms'));
    }


    public function show(Room $room, Request $request)
    {
        $query = Booking::with('user')->where('room_id', $room->id);

        if ($request->has('date') && $request->date) {
            $query->whereDate('start_time', $request->date);
        } else {
            $query->where('start_time', '>=', now());
        }

        $bookings = $query->orderBy('start_time')->get();

        $layout = auth()->user()->hasRole('admin')
            ? 'layouts.templates.app-layout'
            : 'layouts.templates.user-profile-layout';

        $section = auth()->user()->hasRole('admin') ? 'content' : 'content-user-layout';

        return view('app.business.booking.bookings_show', compact('room', 'bookings', 'layout', 'section'));
    }




    public function create(Request $request, Room $room)
    {
        $defaultDate = $request->query('date'); // YYYY-MM-DD

        return view('app.business.booking.bookings_create', compact('room', 'defaultDate'));
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_hour' => ['required', 'date_format:H:i'],
            'end_hour' => ['required', 'date_format:H:i'],
            'description' => ['nullable', 'string'],
        ]);

        $start = Carbon::parse($request->date . ' ' . $request->start_hour);
        $end   = Carbon::parse($request->date . ' ' . $request->end_hour);

        if ($end->lte($start)) {
            return back()
                ->withErrors(['end_hour' => 'A hora fim deve ser maior que a hora início.'])
                ->withInput();
        }

        Booking::create([
            'room_id' => $room->id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'start_time' => $start,
            'end_time' => $end,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('bookings.show', $room)
            ->with('success', 'Agendamento criado com sucesso!');
    }





    public function getBookingsByRoom(Room $room)
    {
        $now = Carbon::now();

        $bookings = $room->bookings()
            ->where('end_time', '>=', $now)
            ->orderBy('start_time')
            ->get(['id', 'title', 'start_time', 'end_time']);

        return response()->json($bookings);
    }

    public function events(Room $room)
    {
        $start = request('start'); // ex: 2026-01-01
        $end   = request('end');   // ex: 2026-02-01

        $bookings = Booking::where('room_id', $room->id)
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('start_time', [$start, $end]);
            })
            ->get();

        return $bookings->map(function ($b) {
            return [
                'id' => $b->id,
                'title' => $b->title,
                'start' => $b->start_time,
                'end' => $b->end_time,
                'description' => $b->description,
            ];
        });
    }

    public function day(Request $request, Room $room)
    {
        try {
            $date = $request->query('date'); // YYYY-MM-DD

            if (!$date) {
                return response()->json(['date' => null, 'bookings' => []], 200);
            }

            // valida data
            $day = Carbon::createFromFormat('Y-m-d', $date);
            $start = $day->copy()->startOfDay();
            $end   = $day->copy()->endOfDay();

            $bookings = Booking::where('room_id', $room->id)
                ->with('user') // se isso quebrar, veja item 2 abaixo
                ->whereBetween('start_time', [$start, $end])
                ->orderBy('start_time')
                ->get()
                ->map(function ($b) {
                    return [
                        'id' => $b->id,
                        'title' => (string) $b->title,
                        'start' => Carbon::parse($b->start_time)->format('H:i'),
                        'end' => Carbon::parse($b->end_time)->format('H:i'),
                        'description' => (string) ($b->description ?? ''),
                        'user' => optional($b->user)->name ?? 'Desconhecido',
                    ];
                });

            return response()->json([
                'date' => $day->format('d/m/Y'),
                'bookings' => $bookings,
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Erro em bookings.day', [
                'room_id' => $room->id ?? null,
                'date' => $request->query('date'),
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // devolve JSON (pra não quebrar o fetch)
            return response()->json([
                'date' => null,
                'bookings' => [],
                'error' => 'Erro interno ao buscar agendamentos do dia.',
            ], 500);
        }
    }

}
