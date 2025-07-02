@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Kamar</h3>

    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Pilih Hotel</label>
            <select name="hotel_id" class="form-select">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}" {{ $room->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Tipe Kamar</label>
            <input name="name" class="form-control" value="{{ $room->name }}">
        </div>

        <div class="mb-3">
            <label>Luas</label>
            <input name="size" class="form-control" value="{{ $room->size }}">
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach(['AC', 'TV', 'Air Panas'] as $f)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="facilities[]" value="{{ $f }}" class="form-check-input"
                        {{ in_array($f, $room->facilities ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Jumlah Unit</label>
            <input type="number" name="units" class="form-control" value="{{ $room->units }}">
        </div>

        <div class="mb-3">
            <label>Foto Baru (opsional)</label>
            <input type="file" name="photo" class="form-control">
            @if($room->photo)
                <img src="{{ asset('storage/' . $room->photo) }}" class="img-thumbnail mt-2" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label>Harga Publish</label>
            <input type="number" name="publish_rate" class="form-control" value="{{ $room->publish_rate }}">
        </div>

        <div class="mb-3">
            <label>Harga Corporate</label>
            <input type="number" name="corporate_rate" class="form-control" value="{{ $room->corporate_rate }}">
        </div>

        <div class="mb-3">
            <label>Periode Berlaku</label>
            <div class="row g-2">
                <div class="col"><input type="date" name="start_date" class="form-control" value="{{ $room->start_date }}"></div>
                <div class="col"><input type="date" name="end_date" class="form-control" value="{{ $room->end_date }}"></div>
            </div>
        </div>

        <div class="mb-3">
            <label>Blackout Dates</label>
            @foreach($room->blackout_dates ?? [null,null] as $date)
                <input type="date" name="blackout_dates[]" value="{{ $date }}" class="form-control mb-1">
            @endforeach
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
