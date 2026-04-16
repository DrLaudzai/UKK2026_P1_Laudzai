<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pelanggaran</title>
    <style>
        body { font-family: Arial; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; }
    </style>
</head>
<body onload="window.print()">

<h2>Laporan Pelanggaran</h2>

@if($from && $to)
<p>Periode: {{ $from }} s/d {{ $to }}</p>
@endif

<table>
    <tr>
        <th>User</th>
        <th>Alat</th>
        <th>Tipe</th>
        <th>Denda</th>
    </tr>

    @foreach ($data as $d)
    <tr>
        <td>{{ $d->user->detail->name ?? '-' }}</td>
        <td>{{ $d->loan->tool->name ?? '-' }}</td>
        <td>{{ strtoupper($d->type) }}</td>
        <td>Rp {{ number_format($d->fine, 0, ',', '.') }}</td>
    </tr>
    @endforeach
</table>

<h3>Total Denda: Rp {{ number_format($totalFine, 0, ',', '.') }}</h3>

</body>
</html>