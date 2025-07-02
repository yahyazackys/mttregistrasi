@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Kamar Baru</h3>

    <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Pilih Hotel</label>
            <select name="hotel_id" class="form-select">
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Tipe Kamar</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Luas</label>
            <input name="size" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach(['AC', 'TV', 'Air Panas'] as $f)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="facilities[]" value="{{ $f }}" class="form-check-input">
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Jumlah Unit</label>
            <input type="number" name="units" class="form-control">
        </div>

        <div class="mb-3">
            <label>Upload Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Publish</label>
            <input type="number" name="publish_rate" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Corporate</label>
            <input type="number" name="corporate_rate" class="form-control">
        </div>

        <div class="mb-3">
            <label>Periode Berlaku</label>
            <div class="row g-2">
                <div class="col"><input type="date" name="start_date" class="form-control"></div>
                <div class="col"><input type="date" name="end_date" class="form-control"></div>
            </div>
        </div>

        <div class="mb-3">
            <label>Blackout Dates (opsional)</label>
            <input type="date" name="blackout_dates[]" class="form-control mb-1">
            <input type="date" name="blackout_dates[]" class="form-control mb-1">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
