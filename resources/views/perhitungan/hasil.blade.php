@section('title','Hasil Perhitungan')
@can('view', App\Hasil::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Hasil Perhitungan") }} @if (Auth::user()->kecamatan_id)
                    Kecamatan {{ Auth::user()->kecamatan->nama }}
                @endif
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                  <div class="pr-4 flex justify-between text-sm">
                    <div class="dropdown dropdown-top dropdown-end ml-2 pt-4">
                    <a href="{{ route('perhitungan.cetak') }}">
                        <button class="btn btn-info btn-sm">Cetak Hasil</button>
                        </a>
                    </div>
                    @if (Auth::user()->kecamatan_id === null)
                        <form method="get" action="{{ route('perhitungan.hasil') }}">
                            <select name="kecamatan_id" class="select select-bordered w-full max-w-xs mt-4" id="kecamatan_id" onchange="this.form.submit()">
                                <option value="" @if(!$selectedKecamatan) selected @endif>Pilih Kecamatan</option>
                                @foreach ($kecamatan as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" @if($selectedKecamatan == $kecamatan->id) selected @endif>{{ $kecamatan->nama }}</option>
                                @endforeach
                            </select>
                        </form>
                    @endif
                  </div>
                {{-- Nilai Alternatif Penerima --}}
                <div class="overflow-x-auto pt-4">
                    <table class="table">
                    <!-- head -->
                    <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                        <tr>
                        <th class="text-sm text-center">Peringkat</th>                            
                        @if (Auth::user()->kecamatan_id === null)
                        <th class="text-sm text-center">Kecamatan</th>
                        @endif
                        <th class="text-sm text-center">Kode Penerima</th>
                        <th class="text-sm text-center">Nama Penerima</th>
                        <th class="text-sm text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penerima as $pnm)
                            @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                            <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            @if (Auth::user()->kecamatan_id === null)
                            <td class="text-center">{{ $pnm->kecamatan->nama }}</td>
                            @endif
                            <td class="text-center">{{ 'A'. $pnm->id }}</td>
                            <td class="text-center">{{ $pnm->nama }}</td>
                            <td class="text-center">{{ number_format($vectorV[$pnm->id] ?? 0, 4) }}</td>
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
