@section('title','Lihat Penerima')
@can('view', App\Penerima::class)
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
                      <div class="dropdown dropdown-top dropdown-end ml-2 ">
                          <label for="entries">Show entries:</label>
                          <select name="entries" class="select select-bordered fw-ull max-w-xs" id="entries" onchange="this.form.submit()">
                              <option value="10" @if(request('entries', 10) == 10) selected @endif>10</option>
                              <option value="25" @if(request('entries', 10) == 25) selected @endif>25</option>
                              <option value="50" @if(request('entries', 10) == 50) selected @endif>50</option>
                          </select>
                      </div>
                      <form method="get" action="{{ route('penerima.lihat') }}" class="mr-auto pl-2">
                          <input type="text" name="search" placeholder="Cari" class="input input-bordered fw-ull max-w-xs" value="{{ request('search') }}">
                      </form>
                      <form method="get" action="{{ route('penerima.lihat') }}">
                          <select name="kecamatan_id" class="select select-bordered w-full max-w-xs ml-2" id="kecamatan_id" onchange="this.form.submit()">
                              <option value="" @if(!$selectedKecamatan) selected @endif>Show All</option>
                              @foreach ($kecamatan as $kecamatan)
                              <option value="{{ $kecamatan->id }}" @if($selectedKecamatan == $kecamatan->id) selected @endif>{{ $kecamatan->nama }}</option>
                              @endforeach
                          </select>
                      </form>
                  </div>
                    <div class="overflow-x-auto">
                      <table class="table">
                        <!-- head -->
                        <thead>
                          <tr>
                            <th class="text-sm text-center pr-20">No</th>
                            <th class="text-sm">Nama</th>
                            <th class="text-sm">Alamat</th>
                            <th class="text-sm text-center">Kecamatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($penerima as $pnm)
                              @if (!$selectedKecamatan || $pnm->kecamatan_id == $selectedKecamatan)
                                  <tr>
                                      <td class="text-center pr-20">{{$loop->iteration}}</td>
                                      <td>{{ $pnm->nama }}</td>
                                      <td>{{ $pnm->alamat }}</td>
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
                  {{ $penerima->links() }}
                  </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
