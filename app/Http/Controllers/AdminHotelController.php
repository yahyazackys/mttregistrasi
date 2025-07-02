<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('user')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.hotels.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
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

        Hotel::create($data);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil ditambahkan');
    }

    public function edit(Hotel $hotel)
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.hotels.edit', compact('hotel', 'vendors'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
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
            // Hapus foto lama
            if ($hotel->photo) {
                Storage::disk('public')->delete($hotel->photo);
            }
            $data['photo'] = $request->file('photo')->store('hotel_photos', 'public');
        }

        $data['facilities'] = $request->facilities ?? [];

        $hotel->update($data);
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil diperbarui');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->photo) {
            Storage::disk('public')->delete($hotel->photo);
        }

        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil dihapus');
    }
}

