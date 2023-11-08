@section('title','Lihat Penerima')
@can('view', App\LihatPenerima::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Penerima") }}
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                  <div class="px-4 pb-2 flex justify-between text-sm">
                    <div class="dropdown dropdown-top dropdown-end ml-2">
                      <form method="get">
                          <label for="entries">Show entries:</label>
                          <select name="entries" class="select select-bordered fw-ull max-w-xs" id="entries" onchange="this.form.submit()">
                              <option value="10" @if(request('entries', 10) == 10) selected @endif>10</option>
                              <option value="25" @if(request('entries', 10) == 25) selected @endif>25</option>
                              <option value="50" @if(request('entries', 10) == 50) selected @endif>50</option>
                              <option value="100" @if(request('entries', 10) == 100) selected @endif>100</option>
                          </select>
                          @if (request()->has('search'))
                              <input type="hidden" name="search" value="{{ request('search') }}">
                          @endif
                      </form>
                    </div>
                    <form method="get" action="{{ route('penerima.lihat') }}" class="mr-auto pl-2">
                        <input type="text" name="search" placeholder="Cari" class="input input-bordered fw-ull max-w-xs" value="{{ request('search') }}">
                        @if (request()->has('entries'))
                            <input type="hidden" name="entries" value="{{ request('entries') }}">
                        @endif
                    </form>
                    <form method="get" action="{{ route('penerima.lihat') }}">
                        <select name="kecamatan_id" class="select select-bordered w-full max-w-xs ml-2" id="kecamatan_id" onchange="this.form.submit()">
                        <option value="" @if(!$selectedKecamatan) selected @endif>Tampilkan Kecamatan</option>
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
                    <div class="overflow-x-auto">
                      <table class="table">
                        <!-- head -->
                        <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                          <tr>
                            <th class="text-sm text-center">No</th>
                            <th class="text-sm">Nama</th>
                            <th class="text-sm">Alamat</th>
                              @foreach ($kriteria as $krit)
                              <th class="text-sm text-center">{{ $krit->nama }}</th>
                              @endforeach
                            <th class="text-sm text-center">Kecamatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($penerima as $pnm)
                              @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                                  <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{ $pnm->nama }}</td>
                                    <td>{{ $pnm->alamat }}</td>
                                    @foreach ($kriteria as $krit)
                                    <td class="text-center">
                                      @foreach ($pnm->nilaiPenerima->where('kriteria_id', $krit->id) as $nilai)
                                    {{ $nilai->subkriteria->nama_sub_kriteria }}
                                    @endforeach
                                    </td>
                                    @endforeach
                                    <td class="text-center">
                                    {{ $pnm->kecamatan->nama }}
                                    </td>
                                  </tr>
                              @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                  <div class="mt-4">
                      {{ $penerima->withQueryString()->links() }}
                  </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
