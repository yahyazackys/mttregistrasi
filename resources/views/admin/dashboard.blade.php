@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Admin Dashboard - Semua Hotel</h3>

   <table class="table table-hover table-bordered align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th>Nama Hotel</th>
            <th>Vendor</th>
            <th>Kota</th>
            <th>Kategori</th>
            <th>Total Kamar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hotels as $hotel)
        <tr>
            <td>
                <strong>{{ $hotel->name }}</strong><br>
                <small class="text-muted">ID: {{ $hotel->id }}</small>
            </td>
            <td>
                <div>
                    <strong>{{ $hotel->user->name }}</strong><br>
                    <small class="text-muted">{{ $hotel->user->email }}</small>
                </div>
            </td>
            <td>{{ $hotel->city }}</td>
            <td>
                <span class="badge bg-info text-dark">{{ $hotel->category }}</span>
            </td>
            <td class="text-center">{{ $hotel->total_rooms }}</td>
            <td class="text-center">
                <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-sm btn-warning mb-1">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.hotels.destroy', $hotel->id) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection