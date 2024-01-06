@section('title', 'Edit Penerima')
@can('view', App\Penerima::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        {{ __('Edit Penerima') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('penerima.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('penerima/' . $penerima->id) }}" method="POST" class="p-4">
                                {!! csrf_field() !!}
                                @method('PATCH')
                                <p class="pl-2 text-gray-900 font-medium text-base">Data Penerima</p>
                                <div class="grid grid-cols-1 gap-6 grid-rows-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 p-4 pb-0">
                                    {{-- Nama --}}
                                    <div>
                                        <x-input-label for="nama" :value="__('Nama Penerima')" />
                                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                            value="{{ $penerima->nama }}" required autocomplete="on"
                                            placeholder="Masukkan nama penerima" />
                                    </div>
                                    {{-- Alamat --}}
                                    <div>
                                        <x-input-label for="alamat" :value="__('Alamat Penerima')" />
                                        <textarea class="textarea textarea-bordered textarea-m w-full" name="alamat" value="{{ $penerima->alamat }}" required
                                            autocomplete="on" placeholder="Masukkan alamat penerima">{{ old('alamat', $penerima->alamat) }}</textarea>
                                    </div>
                                </div>
                                <p class="pl-2 text-gray-900 font-medium text-base">Nilai Penerima</p>
                                <div class="grid grid-cols-1 gap-6 grid-rows-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 p-4">
                                    @foreach ($kriteria as $kr)
                                        <div>
                                            <x-input-label for="nilai"
                                                value="{{ $kr->kode_kriteria }} - {{ $kr->nama }}" />
                                            <x-select id="{{ $kr->id }}" name="nilai[{{ $kr->id }}]"
                                                class="select select-bordered block mt-1 w-full">
                                                @foreach ($kr->subkriteria as $sub)
                                                    <option value="{{ $sub->id }}"
                                                        {{ old('nilai.' . $kr->id, $penerima->nilaiPenerima->where('kriteria_id', $kr->id)->first()->nilai ?? null) == $sub->id ? 'selected' : '' }}>
                                                        {{ $sub->nama_sub_kriteria }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- submit --}}
                                <div class="gap-6">
                                    <input type="submit" value="Edit" class="btn btn-info mt-4 ml-1"></br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan
