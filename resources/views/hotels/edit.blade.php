@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Data Hotel</h2>
    <form method="POST" action="{{ route('hotels.update', $hotel) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Hotel</label>
            <input name="name" value="{{ $hotel->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="address" class="form-control">{{ $hotel->address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kota / Kabupaten</label>
            <input name="city" value="{{ $hotel->city }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Google Maps Embed</label>
            <input name="map_embed" value="{{ $hotel->map_embed }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori Hotel</label>
            <select name="category" class="form-select">
                <option value="Non-bintang" {{ $hotel->category == 'Non-bintang' ? 'selected' : '' }}>Non-bintang</option>
                @for($i=1;$i<=5;$i++)
                    <option value="Bintang {{ $i }}" {{ $hotel->category == 'Bintang '.$i ? 'selected' : '' }}>Bintang {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah Total Kamar</label>
            <input type="number" name="total_rooms" value="{{ $hotel->total_rooms }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach (['WiFi', 'Parkir', 'Sarapan'] as $f)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $f }}" {{ in_array($f, $hotel->facilities ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Upload Foto Baru (opsional)</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
