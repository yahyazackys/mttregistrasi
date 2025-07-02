<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 6px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h3>Daftar Kamar</h3>
    <table>
        <thead>
            <tr>
                <th>Hotel</th>
                <th>Kamar</th>
                <th>Luas</th>
                <th>Publish</th>
                <th>Corporate</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->hotel->name }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->size }}</td>
                <td>Rp{{ number_format($room->publish_rate) }}</td>
                <td>Rp{{ number_format($room->corporate_rate) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
