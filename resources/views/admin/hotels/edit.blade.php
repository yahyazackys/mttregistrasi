@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Hotel</h3>

    <form method="POST" action="{{ route('admin.hotels.update', $hotel->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Vendor</label>
            <select name="user_id" class="form-select">
                @foreach($vendors as $v)
                    <option value="{{ $v->id }}" {{ $v->id == $hotel->user_id ? 'selected' : '' }}>
                        {{ $v->pic_name ?? $v->name }} ({{ $v->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Hotel</label>
            <input name="name" class="form-control" value="{{ $hotel->name }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ $hotel->address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kota</label>
            <input name="city" class="form-control" value="{{ $hotel->city }}">
        </div>

        <div class="mb-3">
            <label>Embed Google Maps</label>
            <input name="map_embed" class="form-control" value="{{ $hotel->map_embed }}">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category" class="form-select">
                <option value="Non-bintang" {{ $hotel->category == 'Non-bintang' ? 'selected' : '' }}>Non-bintang</option>
                @for($i=1; $i<=5; $i++)
                    <option value="Bintang {{ $i }}" {{ $hotel->category == "Bintang $i" ? 'selected' : '' }}>Bintang {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label>Total Kamar</label>
            <input type="number" name="total_rooms" class="form-control" value="{{ $hotel->total_rooms }}">
        </div>

        <div class="mb-3">
            <label>Fasilitas</label><br>
            @foreach(['WiFi', 'Parkir', 'Sarapan'] as $f)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="facilities[]" value="{{ $f }}" class="form-check-input"
                        {{ in_array($f, $hotel->facilities ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $f }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Ganti Foto</label>
            <input type="file" name="photo" class="form-control">
            @if($hotel->photo)
                <img src="{{ asset('storage/' . $hotel->photo) }}" class="img-thumbnail mt-2" width="120">
            @endif
        </div>

        <button class="btn btn-success">Update Hotel</button>
    </form>
</div>
@endsection
