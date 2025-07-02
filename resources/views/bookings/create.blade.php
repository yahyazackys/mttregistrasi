@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Booking: {{ $room->name }} - {{ $room->hotel->name }}</h3>

    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <input type="hidden" name="hotel_id" value="{{ $room->hotel_id }}">

        <div class="mb-3">
            <label>Tanggal Check-In</label>
            <input type="date" name="tanggal_checkin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Check-Out</label>
            <input type="date" name="tanggal_checkout" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Kamar</label>
            <input type="number" name="jumlah_kamar" class="form-control" required>
        </div>

        <button class="btn btn-success">Booking Sekarang</button>
    </form>
</div>
@endsection
