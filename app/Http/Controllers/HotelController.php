<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
   public function index()
{
    $hotels = \App\Models\Hotel::where('user_id', auth()->id())->get(); // jadi collection
    return view('hotels.index', compact('hotels'));
}


public function listForUser()
{
    $hotels = \App\Models\Hotel::with('rooms')->get();
    $total = $hotels->sum(fn($hotel) => $hotel->rooms->count());

    return view('hotels.user_index', compact('hotels', 'total'));
}


public function create()
{
    return view('hotels.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'map_embed' => 'nullable',
        'category' => 'required',
        'total_rooms' => 'required|integer',
        'facilities' => 'array',
        'photo' => 'image|nullable',
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('hotel_photos', 'public');
    }

    $data['user_id'] = auth()->id();
    $data['facilities'] = $request->facilities ?? [];

    Hotel::create($data);
    return redirect()->route('rooms.create');
}
public function show(Hotel $hotel)
    {
        $hotel->load('rooms');
        return view('hotels.show', compact('hotel'));
    }

public function edit(Hotel $hotel)
{
    return view('hotels.edit', compact('hotel'));
}

public function update(Request $request, Hotel $hotel)
{
    $data = $request->validate([
        'name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'map_embed' => 'nullable',
        'category' => 'required',
        'total_rooms' => 'required|integer',
        'facilities' => 'array',
        'photo' => 'image|nullable',
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('hotel_photos', 'public');
    }

    $data['facilities'] = $request->facilities ?? [];
    $hotel->update($data);

    return redirect()->route('hotels.index');
}

}
