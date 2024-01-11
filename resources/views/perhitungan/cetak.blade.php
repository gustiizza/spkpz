<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Perhitungan</title>
    <style type="text/css">
body {
    font-family: 'Times New Roman', Times, serif;
}

* {
    font-family: 'Times New Roman', Times, serif;
}

        h1 {
            font-size: large;
        }

        tfoot tr td {
            font-weight: bold;
        }

        .gray {
            background-color: lightgray;
        }

        hr.new4 {
            border: 1px solid black;
        }

        h1,
        h3,
        h5,
        h6 {
            text-align: center;
          
            margin: 0;
        }

        .row {
            margin-top: 20px;
        }
        header {
            display: flex;
            justify-content: center;
            align-items: baseline; /* You can also use 'stretch' */
        }
        
        .logo {
            height: 100px;
            width: auto;
            margin-right: 10px; /* Adjust the margin as needed */
        }
#text-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto; /* Add this line */
}

        
        #img {
            display: flex; /* Add this line */
            align-items: center;
            justify-content: center;
        }
        
.logo {
    height: 100px;
    width: auto;
    margin: 0 auto; /* Add this line */
}

        .kablogo,
        .keclogo,
        .alamatlogo,
        .kodeposlogo {
            text-align: center; 
            margin: 0;
        }
@media print {
    #text-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .logo {
        margin: 0 auto;
    }
}
    </style>

</head>

<body>
    <header>
        <!--<img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" />-->
        <div class="row">
            <div id="text-header">
                <h1 class="kablogo"><strong>BADAN AMIN ZAKAT NASIONAL</strong></h1>
                <h1 class="keclogo"><strong>KABUPATEN MEMPAWAH</strong></h1>
                <h6 class="alamatlogo">Sekretariat BAZNAS Jl. Raden Kusno Komplek Masjid Agung Al Falah</h6>
                <h5 class="kodeposlogo"><strong>Telepon: 0561 692719, Surel: baznaskab.mempawah@baznas.go.id</strong>
                </h5>
            </div>
        </div>
    </header>
    <hr class="new4">
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
    </table>
</body>

</html>