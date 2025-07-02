<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking #{{ $booking->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { padding: 8px; border: 1px solid #000; }
        .ttd { width: 100%; text-align: right; margin-top: 50px; }
        .ttd div { margin-top: 70px; }
    </style>
</head>
<body>
    <h3>Detail Booking</h3>

    <table>
        <tr>
            <th>Hotel</th>
            <td>{{ $booking->hotel->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tipe Kamar</th>
            <td>{{ $booking->room->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Check-In</th>
            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkin)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Check-Out</th>
            <td>{{ \Carbon\Carbon::parse($booking->tanggal_checkout)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Jumlah Kamar</th>
            <td>{{ $booking->jumlah_kamar }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
        </tr>
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
