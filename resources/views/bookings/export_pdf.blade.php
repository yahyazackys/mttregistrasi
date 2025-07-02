<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Booking</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        .ttd { width: 100%; text-align: right; margin-top: 50px; }
        .ttd div { margin-top: 70px; }
    </style>
</head>
<body>
    <h3>Riwayat Booking</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hotel</th>
                <th>Tipe Kamar</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $i => $b)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $b->hotel->name ?? '-' }}</td>
                <td>{{ $b->room->name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_checkin)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_checkout)->format('d M Y') }}</td>
                <td>{{ $b->jumlah_kamar }}</td>
                <td>Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <p>{{ now()->translatedFormat('d F Y') }}, di Jakarta</p>
        <div>
            <strong>ipan</strong><br>
            <em>(Tanda Tangan)</em>
        </div>
    </div>
</body>
</html>
