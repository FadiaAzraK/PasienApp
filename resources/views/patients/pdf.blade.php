<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #444;
            color: white;
            padding: 6px;
            font-size: 12px;
        }

        td {
            padding: 6px;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid #999;
        }

        tr:nth-child(even) {
            background: #f3f3f3;
        }
    </style>
</head>
<body>

<h3>Daftar Pasien</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Gender</th>
            <th>Tgl Lahir</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>

    <tbody>
        @foreach($patients as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->nik }}</td>
            <td>{{ $p->gender }}</td>
            <td>{{ $p->birth_date ? \Carbon\Carbon::parse($p->birth_date)->format('d-m-Y') : '-' }}</td>
            <td>{{ $p->phone }}</td>
            <td>{{ $p->address }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>