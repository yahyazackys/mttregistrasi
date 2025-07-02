@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Hotel Baru</h3>

    <form method="POST" action="{{ route('admin.hotels.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Vendor</label>
            <select name="user_id" class="form-select">
                @foreach($vendors as $v)
                    <option value="{{ $v->id }}">{{ $v->pic_name ?? $v->name }} ({{ $v->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Hotel</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Kota</label>
            <input name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Google Maps Embed (opsional)</label>
            <input name="map_embed" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category" class="form-select">
                <option value="Non-bintang">Non-bintang</option>
                @for($i=1; $i<=5; $i++)
                    <option value="Bintang {{ $i }}">Bintang {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label>Total Kamar</label>
            <input type="number" name="total_rooms" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach(['WiFi', 'Parkir', 'Sarapan'] as $f)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="facilities[]" value="{{ $f }}" class="form-check-input">
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Upload Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan Hotel</button>
    </form>
</div>
@endsection
