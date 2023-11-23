@section('title', 'Edit Sub Kriteria')
@can('view', App\SubKriteria::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        {{ __('Edit Sub Kriteria') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('subkriteria.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('subkriteria/' . $subkriteria->id) }}" method="POST" class="p-4">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">

                                    {!! csrf_field() !!}
                                    @method('PATCH')
                                    {{-- Pilih Kriteria --}}
                                    <div>
                                        <x-input-label for="kriteria_id" :value="__('Pilih Kriteria')" />
                                        <select id="kriteria_id" class="select select-bordered block mt-1 w-full"
                                            name="kriteria_id" required autocomplete="kriteria_id">
                                            @foreach ($kriteria as $ktr)
                                                <option value="{{ $ktr->id }}"
                                                    {{ $subkriteria->kriteria && $subkriteria->kriteria->id == $ktr->id ? 'selected' : '' }}>
                                                    {{ $ktr->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('kriteria_id')" class="mt-2" />
                                    </div>

                                    {{-- Nama Sub Kriteria --}}
                                    <div>
                                        <x-input-label for="nama_sub_kriteria" :value="__('Nama Sub Kriteria')" />
                                        <x-text-input id="nama_sub_kriteria" class="block mt-1 w-full" type="text"
                                            name="nama_sub_kriteria" value="{{ $subkriteria->nama_sub_kriteria }}" required
                                            autocomplete="nama_sub_kriteria" placeholder="Masukkan nama sub kriteria" />
                                        <x-input-error :messages="$errors->get('nama_sub_kriteria')" class="mt-2" />
                                    </div>
                                    {{-- Nilai --}}
                                    <div>
                                        <x-input-label for="nilai_sk" :value="__('Nilai Sub Kriteria')" />
                                        <x-text-input id="nilai_sk" class="block mt-1 w-full" type="number"
                                            name="nilai_sk" value="{{ $subkriteria->nilai_sk }}" required
                                            autocomplete="nama" placeholder="Masukkan nama sub kriteria" />
                                        <x-input-error :messages="$errors->get('nilai_sk')" class="mt-2" />
                                    </div>
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
