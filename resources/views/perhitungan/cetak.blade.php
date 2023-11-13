<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Hasil Perhitungan</title>
    <style>
        .table {
  border-collapse: collapse;
}
    </style>
</head>
<body>
	<header>
                <div >
                    <h2 style="text-align: center">
                    Sistem Pendukung Keputusan Penentuan Penerima Zakat
                    <br>
                    BAZNAS Kabupaten Mempawah
                    </h2>
                </div>
            </header>
	<h3 style="text-align: center">Hasil Perhitungan @if (Auth::user()->kecamatan_id)
                    Kecamatan {{ Auth::user()->kecamatan->nama }}
                @endif</h3>
	<p>{{ \Carbon\Carbon::now()->isoFormat('LL') }}</p>
	<div style="margin: 2rem"></div>
	<table style="width: 100%">
		<thead>
			<tr style="background-color: #cfcfcf;">
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
            @foreach($penerima as $pnm)
                <tr>
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    @if (Auth::user()->kecamatan_id === null)
                    <td style="text-align: center">{{ $pnm->kecamatan->nama }}</td>
                    @endif
                    <td style="text-align: center">{{ 'A'. $pnm->id }}</td>
                    <td style="text-align: center">{{ $pnm->nama }}</td>
                    <td style="text-align: center">{{ number_format($vectorV[$pnm->id] ?? 0, 4) }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>