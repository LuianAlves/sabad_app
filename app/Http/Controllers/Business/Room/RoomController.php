<?php

namespace App\Http\Controllers\Business\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Room\StoreRoomRequest;
use App\Http\Requests\Business\Room\UpdateRoomRequest;
use App\Models\Business\Company\Company;
use App\Models\Business\Room\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::with('company')->orderBy('company_id', 'ASC')->get();

        return view('app.business.room.room_index', compact('rooms'));
    }


    public function create()
    {
        $companies = Company::all();
        return view('app.business.room.room_create', compact('companies'));
    }


    public function store(StoreRoomRequest $request)
    {
        $request->validated();
        $room = Room::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
        ]);

        return redirect()->route('room.index');
    }


    public function show($id)
    {
        $room = Room::find($id);
        return view('app.business.room.room_show', compact('room'));
    }


    public function edit($id)
    {
        $room = Room::find($id);
        $companies = Company::get();

        return view('app.business.room.room_edit', compact('room', 'companies'));
    }


    public function update(UpdateRoomRequest $request, $id)
    {
        $request->validated();

        $room = Room::find($id);

        $room->update([
            'company_id' => $request->company_id,
            'name' => $request->name,
        ]);

        return redirect()->route('room.index');
    }


    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('room.index');
    }
}
