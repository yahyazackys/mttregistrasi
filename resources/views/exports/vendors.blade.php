<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <thead>
        <tr>
            <th>Nama PIC</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Tanggal Registrasi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendors as $vendor)
            <tr>
                <td>{{ $vendor->pic_name }}</td>
                <td>{{ $vendor->email }}</td>
                <td>{{ $vendor->phone }}</td>
                <td>{{ \Carbon\Carbon::parse($vendor->created_at)->format('d-m-Y') }}</td>
                <td>{{ $vendor->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>