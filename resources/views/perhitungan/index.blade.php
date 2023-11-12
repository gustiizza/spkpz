@section('title','Perhitungan')
@can('view', App\Perhitungan::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}

              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                  <div class="flex justify-between text-sm">
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Perhitungan Metode Weighted Product") }}
                </div>  
                    <form method="get" action="{{ route('perhitungan.index') }}">
                        <select name="kecamatan_id" class="select select-bordered w-full max-w-xs mt-4" id="kecamatan_id" onchange="this.form.submit()">
                        <option value="" @if(!$selectedKecamatan) selected @endif>Pilih Kecamatan</option>
                        @foreach ($kecamatan as $kecamatan)
                            <option value="{{ $kecamatan->id }}" @if($selectedKecamatan == $kecamatan->id) selected @endif>{{ $kecamatan->nama }}</option>
                        @endforeach
                        </select>
                        @if (request()->has('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request()->has('entries'))
                            <input type="hidden" name="entries" value="{{ request('entries') }}">
                        @endif
                    </form>
                  </div>
                  {{-- Nilai Alternatif Penerima --}}
                <div class="overflow-x-auto pt-4">
                    <p class="pl-2 text-gray-900 font-medium text-base text-center underline decoration-success">Nilai Alternatif Penerima</p>
                    <table class="table">
                    <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                        <tr>
                        <th class="text-sm text-center">No</th>
                        <th class="text-sm text-center">Kecamatan</th>
                        <th class="text-sm text-center">Kode Penerima</th>
                            @foreach ($kriteria as $krit)
                            <th class="text-sm text-center">{{ $krit->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $pnm)
                            @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                            <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ $pnm->kecamatan->nama }}</td>
                            <td class="text-center">{{ 'A'. $pnm->id }}</td>
                            @foreach ($kriteria as $krit)
                            <td class="text-center">
                                @foreach ($pnm->nilaiPenerima->where('kriteria_id', $krit->id) as $nilai)
                            {{ $nilai->subkriteria->nilai_sk }}
                            @endforeach
                            </td>
                            @endforeach
                            
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    </table>
                </div>
                {{-- Bobot --}}
                <div class="overflow-x-auto pt-10">
                    <p class="pl-2 text-gray-900 font-medium text-base text-center underline decoration-success">Normalisasi Bobot</p>
                    <table class="table">
                    <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                        <tr>
                        <th class="text-sm text-center">Kode Kriteria</th>
                        <th class="text-sm">Nama Kriteria</th>
                        <th class="text-sm text-center">Bobot Kriteria</th>
                        <th class="text-sm text-center">Atribut</th>
                        <th class="text-sm text-center">Nilai Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($bobot as $bb)
                        <tr>
                            <td class="text-center">{{ $bb->kriteria->kode_kriteria }}</td>
                            <td>{{ $bb->kriteria->nama }}</td>
                            <td class="text-center">{{ $bb->nilai_bk }}</td>
                            <td class="text-center">{{ $bb->kriteria->atribut }}</td>
                            <td class="text-center">{{ $normalizedWeights[$bb->kriteria->id] ?? '' }}</td>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th class="text-sm"></th>
                            <th class="font-medium">Total Bobot</th>
                            <th class="font-medium text-center">{{ $bobot->sum('nilai_bk') }}</th>
                            <th class="text-sm"></th>
                            <th class="text-sm"></th>
                            <th class="text-sm"></th>
                        </tr>
                    </tbody>
                    </table>
                </div>
                {{-- Vektor S --}}
                <div class="overflow-x-auto pt-10">
                    <p class="pl-2 text-gray-900 font-medium text-base text-center underline decoration-success">Vektor S</p>
                    <table class="table">
                    <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                        <tr>
                        <th class="text-sm text-center">No</th>
                        <th class="text-sm text-center">Kecamatan</th>
                        <th class="text-sm text-center">Kode Penerima</th>
                        <th class="text-sm text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $pnm)
                            @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                            <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ $pnm->kecamatan->nama }}</td>
                            <td class="text-center">{{ 'A'. $pnm->id }}</td>
                            <td class="text-center">{{ number_format($vectorS[$pnm->id] ?? 0, 4) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <th></th></th>
                            <th></th>
                            <th class="font-medium text-center">Total vectorS</th>
                            <th class="font-medium text-center">{{ number_format($vectorS->sum() ?? 0, 4) }}</th>
                        </tr>
                    </tbody>
                    </table>
                </div>
                {{-- Vektor V (Perangkingan) --}}
                <div class="overflow-x-auto pt-10">
                    <p class="pl-2 text-gray-900 font-medium text-base text-center underline decoration-success">Vektor V</p>
                    <table class="table">
                    <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                        <tr>
                        <th class="text-sm text-center">No</th>
                        <th class="text-sm text-center">Kecamatan</th>
                        <th class="text-sm text-center">Kode Penerima</th>
                        <th class="text-sm text-center">Penerima</th>
                        <th class="text-sm text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $pnm)
                            @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                            <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ $pnm->kecamatan->nama }}</td>
                            <td class="text-center">{{ 'A'. $pnm->id }}</td>
                            <td class="text-center">{{ $pnm->nama }}</td>
                            <td class="text-center font-bold">{{ number_format($vectorV[$pnm->id] ?? 0, 4) }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
