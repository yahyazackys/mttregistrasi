@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Profil Hotel Anda</h2>

    @if ($hotels)
    <div class="card">
        <div class="card-body">
            <h5>{{ $hotels->name }}</h5>
            <p>{{ $hotels->address }}</p>
            <p><strong>Kota:</strong> {{ $hotels->city }}</p>
            <p><strong>Kategori:</strong> {{ $hotels->category }}</p>
            <p><strong>Total Kamar:</strong> {{ $hotels->total_rooms }}</p>
            <p><strong>Fasilitas:</strong> {{ implode(', ', $hotels->facilities ?? []) }}</p>
            @if($hotels->map_embed)
            <iframe src="{{ $hotels->map_embed }}" width="100%" height="200" style="border:0;" allowfullscreen></iframe>
            @endif
            @if($hotels->photo)
            <img src="{{ asset('storage/' . $hotels->photo) }}" class="img-fluid mt-3" width="300">
            @endif
            <a href="{{ route('hotelss.edit', $hotels) }}" class="btn btn-primary mt-3">Edit Hotels</a>
        </div>
    </div>
    @else
        <p>Data hotels belum tersedia. Silakan isi.</p>
        <a href="{{ route('hotels.create') }}" class="btn btn-success">Isi Data Hotel</a>
    @endif
</div>
@endsection
