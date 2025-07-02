@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Tipe Kamar Baru</h2>

    <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Tipe Kamar</label>
            <input name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Luas Kamar</label>
            <input name="size" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach(['TV', 'AC', 'Air Panas'] as $f)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $f }}">
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Jumlah Unit</label>
            <input type="number" name="units" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto Kamar</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Publish Rate</label>
            <input type="number" name="publish_rate" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Corporate Rate</label>
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
            <input type="date" name="blackout_dates[]" class="form-control">
        </div>

        <button class="btn btn-success">Simpan Kamar</button>
    </form>
</div>
@endsection
