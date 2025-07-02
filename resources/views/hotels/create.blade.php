@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Input Data Hotel</h2>
    <form method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Hotel</label>
            <input name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Kota / Kabupaten</label>
            <input name="city" class="form-control">
        </div>

        <div class="mb-3">
            <label>Google Maps Embed (URL)</label>
            <input name="map_embed" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori Hotel</label>
            <select name="category" class="form-select">
                <option value="Non-bintang">Non-bintang</option>
                @for($i=1;$i<=5;$i++)
                    <option value="Bintang {{ $i }}">Bintang {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah Total Kamar</label>
            <input type="number" name="total_rooms" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach (['WiFi', 'Parkir', 'Sarapan'] as $f)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $f }}">
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Upload Foto Hotel</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Lanjut ke Detail Kamar</button>
    </form>
</div>
@endsection
