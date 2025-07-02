<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   public function index()
{
    $rooms = Room::where('hotel_id', auth()->user()->hotel->id)->get();
    return view('rooms.index', compact('rooms'));
}

public function create()
{
    return view('rooms.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'size' => 'required',
        'facilities' => 'array',
        'units' => 'required|integer',
        'photo' => 'image|nullable',
        'publish_rate' => 'required|numeric',
        'corporate_rate' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'blackout_dates' => 'array|nullable'
    ]);

    $data['hotel_id'] = auth()->user()->hotel->id;

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('room_photos', 'public');
    }

    $data['facilities'] = $request->facilities ?? [];
    $data['blackout_dates'] = $request->blackout_dates ?? [];

    Room::create($data);
    return redirect()->route('rooms.index');
}

public function edit(Room $room)
{
    return view('rooms.edit', compact('room'));
}

public function update(Request $request, Room $room)
{
    $data = $request->validate([
        'name' => 'required',
        'size' => 'required',
        'facilities' => 'array',
        'units' => 'required|integer',
        'photo' => 'image|nullable',
        'publish_rate' => 'required|numeric',
        'corporate_rate' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'blackout_dates' => 'array|nullable'
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('room_photos', 'public');
    }

    $data['facilities'] = $request->facilities ?? [];
    $data['blackout_dates'] = $request->blackout_dates ?? [];

    $room->update($data);
    return redirect()->route('rooms.index');
}

}
