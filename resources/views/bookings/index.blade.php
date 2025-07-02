@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('bookings.export.pdf') }}" class="btn btn-outline-danger mb-3">
        <i class="fas fa-file-pdf"></i> Cetak PDF
    </a>

    <h3 class="mb-4">Riwayat Booking Anda</h3>

    @if($bookings->isEmpty())
    <div class="alert alert-info">Belum ada booking yang tercatat.</div>
    @else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Hotel</th>
                <th>Tipe Kamar</th>
                <th>Tgl Check-In</th>
                <th>Tgl Check-Out</th>
                <th>Jumlah Kamar</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $b->hotel->name ?? '-' }}</td>
                <td>{{ $b->room->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_checkin)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_checkout)->format('d M Y') }}</td>
                <td>{{ $b->jumlah_kamar }}</td>
                <td>Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
                <td><span class="badge bg-success">Terkonfirmasi</span></td>
                <td>
                    <a href="{{ route('bookings.pdf.single', $b->id) }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection