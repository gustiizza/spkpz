@section('title','Tambah Penerima')
@can('view', App\Penerima::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                    {{ __("Tambah Penerima") }}
                    <div class="flex justify-between pr-12 pt-4">
                        <a href="{{ route('penerima.index') }}">
                            <button class="btn btn-secondary btn-sm">Kembali</button>
                        </a>
                    </div>
                </div>
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                    <form action="{{ url('penerima') }}" method="POST" class="p-4">
                        @csrf
                        <div class="grid grid-cols-2 grid-rows-1 gap-6">
                            {{-- Nama--}}
                            <div>
                            <x-input-label for="nama" :value="__('Nama Penerima')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autocomplete="nama" placeholder="Masukkan nama penerima" />
                            </div>
                            {{-- Alamat--}}
                            <div>
                            <x-input-label for="alamat" :value="__('Alamat Penerima')" />
                            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autocomplete="alamat" placeholder="Masukkan alamat penerima" />
                            </div>
                            {{-- Nilai --}}
                            @foreach($kriteria as $kr)
                            <div>
                                <x-input-label for="nilai" value="{{ $kr->kode_kriteria }} - {{ $kr->nama }}"/>
                                <x-select id="{{ $kr->id }}" name="nilai[{{ $kr->id }}]"  class="select select-bordered block mt-1 w-full">
                                    @foreach($kr->subkriteria as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->nama_sub_kriteria }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            @endforeach
                            {{-- submit --}}
                        </div>
                        <div class="gap-6">
                            <input type="submit" value="Tambah" class="btn btn-success mt-4 ml-1"></br>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
