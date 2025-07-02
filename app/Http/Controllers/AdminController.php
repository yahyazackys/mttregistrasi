<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
{
    $query = Room::with('hotel');

    if ($request->hotel_id) {
        $query->where('hotel_id', $request->hotel_id);
    }

    $rooms = $query->get();
    $hotels = \App\Models\Hotel::all();

    return view('admin.rooms.index', compact('rooms', 'hotels'));
}

public function listVendors()
{
    $vendors = User::where('role', 'vendor')->get();
    return view('vendor.index', compact('vendors'));
}
}
