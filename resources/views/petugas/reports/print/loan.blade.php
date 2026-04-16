<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: Arial; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; }
    </style>
</head>
<body onload="window.print()">

<h2>Laporan Peminjaman</h2>

@if($from && $to)
<p>Periode: {{ $from }} s/d {{ $to }}</p>
@endif

<table>
    <tr>
        <th>User</th>
        <th>Alat</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach ($data as $d)
    <tr>
        <td>{{ $d->user->detail->name ?? '-' }}</td>
        <td>{{ $d->tool->name ?? '-' }}</td>
        <td>{{ $d->status }}</td>
        <td>{{ $d->created_at }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>