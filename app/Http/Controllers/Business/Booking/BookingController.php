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




    public function create(Room $room)
    {
        return view('app.business.booking.bookings_create', compact('room'));
    }



    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
        ]);

        $start = Carbon::parse($validated['start_time']);
        $end = Carbon::parse($validated['end_time']);

        // Verifica conflito de horários para a mesma sala e mesmo dia
        $conflictingBooking = Booking::where('room_id', $room->id)
            ->whereDate('start_time', $start->toDateString())
            ->where(function($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->first();

        if ($conflictingBooking) {
            return redirect()->back()
                ->withErrors(['start_time' => 'Conflito: Já existe um agendamento para esta sala neste horário.'])
                ->withInput();
        }

        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'start_time' => $start,
            'end_time' => $end,
        ]);

        return redirect()->route('bookings.show', $room)->with('success', 'Agendamento criado com sucesso!');
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

}
