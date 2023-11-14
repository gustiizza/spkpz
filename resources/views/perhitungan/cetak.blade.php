<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Perhitungan</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        h1 {
            font-size: large;
        }

        tfoot tr td {
            font-weight: bold;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>
    <header>
        <div>
            <h1 style="text-align: center">
                Sistem Pendukung Keputusan Penentuan Penerima Zakat
                <br>
                BAZNAS Kabupaten Mempawah
            </h1>
        </div>
    </header>
    <br />
    <h3 style="text-align: center">Hasil Perhitungan @if (Auth::user()->kecamatan_id)
            Kecamatan {{ Auth::user()->kecamatan->nama }}
        @endif
    </h3>
    <p>{{ \Carbon\Carbon::now()->isoFormat('LL') }}</p>
    <table width="100%">
        <thead>
            <tr style="background-color: lightgray;">
                <th>Peringkat</th>
                @if (Auth::user()->kecamatan_id === null)
                    <th>Kecamatan</th>
                @endif
                <th>Kode Penerima</th>
                <th>Nama Penerima</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($penerima as $pnm)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    @if (Auth::user()->kecamatan_id === null)
                        <td style="text-align: center">{{ $pnm->kecamatan->nama }}</td>
                    @endif
                    <td style="text-align: center">{{ 'A' . $pnm->id }}</td>
                    <td style="text-align: center">{{ $pnm->nama }}</td>
                    <td style="text-align: center">{{ number_format($vectorV[$pnm->id] ?? 0, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>
</body>
</html>