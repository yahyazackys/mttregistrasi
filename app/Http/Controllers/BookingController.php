<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = \App\Models\Booking::with(['room', 'hotel'])
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }


    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'room_id' => 'required|exists:rooms,id',
            'hotel_id' => 'required|exists:hotels,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            'jumlah_kamar' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($r->room_id);
        $days = now()->parse($r->tanggal_checkin)->diffInDays(now()->parse($r->tanggal_checkout));
        $total = $room->corporate_rate * $r->jumlah_kamar * max($days, 1);

        Booking::create([
            'user_id' => auth()->id(),
            'hotel_id' => $room->hotel_id,
            'room_id' => $room->id,
            'tanggal_checkin' => $r->tanggal_checkin,
            'tanggal_checkout' => $r->tanggal_checkout,
            'jumlah_kamar' => $r->jumlah_kamar,
            'total_harga' => $total,
        ]);

        return redirect()->route('home')->with('success', 'Booking berhasil!');
    }

    public function exportPdf()
    {
        $bookings = \App\Models\Booking::with(['room', 'hotel'])
            ->get();


        $pdf = Pdf::loadView('bookings.export_pdf', compact('bookings'));

        return $pdf->download('riwayat-booking.pdf');
    }

    public function downloadSingle($id)
{
    $booking = \App\Models\Booking::with(['hotel', 'room'])
        ->findOrFail($id);

    $pdf = Pdf::loadView('bookings.single_pdf', compact('booking'));

    return $pdf->download('booking-' . $booking->id . '.pdf');
}
}
