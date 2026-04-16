<!DOCTYPE html>
<html>
<head>
    <title>Laporan Settlement</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .total {
            margin-top: 10px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>LAPORAN SETTLEMENT</h2>

    @if($from && $to)
        <p>Periode: {{ $from }} s/d {{ $to }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Alat</th>
                <th>Tipe Pelanggaran</th>
                <th>Denda</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $s)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $s->violation->user->detail->name ?? '-' }}</td>
                    <td>{{ optional($s->violation->loan->tool)->name ?? '-' }}</td>
                    <td>{{ strtoupper($s->violation->type ?? '-') }}</td>
                    <td>
                        Rp {{ number_format($s->violation->fine ?? 0, 0, ',', '.') }}
                    </td>
                    <td>
                        {{ $s->settled_at ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Denda: Rp {{ number_format($totalFine, 0, ',', '.') }}
    </div>

</body>
</html>