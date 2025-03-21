@section('title', 'Edit Bobot')
@can('view', App\Bobot::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        <x-error-info />
                        {{ __('Edit Bobot') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('bobot.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('bobot/' . $bobot->id) }}" method="POST" class="p-4">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">

                                    @csrf
                                    @method('PATCH')
                                    {{-- Pilih Kriteria --}}
                                    <div>
                                        <x-input-label for="kriteria_id" :value="__('Pilih Kriteria')" />
                                        <select id="kriteria_id" class="select select-bordered block mt-1 w-full"
                                            name="kriteria_id" required autocomplete="kriteria_id" disabled>
                                            @foreach ($kriteria as $ktr)
                                                <option value="{{ $ktr->id }}"
                                                    {{ $bobot->kriteria && $bobot->kriteria->id == $ktr->id ? 'selected' : '' }}>
                                                    {{ $ktr->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Nilai --}}
                                    <div>
                                        <x-input-label for="nilai_bk" :value="__('Nama Bobot')" />
                                        <x-text-input id="nilai_bk" class="block mt-1 w-full" type="number"
                                            name="nilai_bk" value="{{ $bobot->nilai_bk }}" required autocomplete="nama"
                                            placeholder="Masukkan nama sub kriteria" />
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
