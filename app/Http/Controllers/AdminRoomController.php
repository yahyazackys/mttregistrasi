<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('hotel')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::all();
        return view('admin.rooms.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required',
            'size' => 'required',
            'facilities' => 'array',
            'units' => 'required|integer',
            'photo' => 'image|nullable',
            'publish_rate' => 'required|numeric',
            'corporate_rate' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'blackout_dates' => 'array|nullable',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('room_photos', 'public');
        }

        $data['facilities'] = $request->facilities ?? [];
        $data['blackout_dates'] = $request->blackout_dates ?? [];

        Room::create($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::all();
        return view('admin.rooms.edit', compact('room', 'hotels'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required',
            'size' => 'required',
            'facilities' => 'array',
            'units' => 'required|integer',
            'photo' => 'image|nullable',
            'publish_rate' => 'required|numeric',
            'corporate_rate' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'blackout_dates' => 'array|nullable',
        ]);

        if ($request->hasFile('photo')) {
            if ($room->photo) {
                Storage::disk('public')->delete($room->photo);
            }
            $data['photo'] = $request->file('photo')->store('room_photos', 'public');
        }

        $data['facilities'] = $request->facilities ?? [];
        $data['blackout_dates'] = $request->blackout_dates ?? [];

        $room->update($data);
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui');
    }

    public function destroy(Room $room)
    {
        if ($room->photo) {
            Storage::disk('public')->delete($room->photo);
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $query = Room::with('hotel');

        if ($request->hotel_id) {
            $query->where('hotel_id', $request->hotel_id);
        }

        $rooms = $query->get();

        $pdf = Pdf::loadView('admin.rooms.pdf', compact('rooms'));
        return $pdf->download('daftar_kamar.pdf');
    }
}
