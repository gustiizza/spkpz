@section('title', 'Tambah Bobot')
@can('view', App\Bobot::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        <x-error-info />
                        {{ __('Tambah Bobot') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('bobot.index') }}">
                                <button class="btn btn-secondary">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('bobot') }}" method="POST" class="p-2">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                                    @csrf
                                    {{-- Pilih Kriteria --}}
                                    <div>
                                        <x-input-label for="kriteria_id" :value="__('Pilih Kriteria')" />
                                        <select id="kriteria_id" class="select select-bordered block mt-1 w-full"
                                            name="kriteria_id" required autocomplete="kriteria_id">
                                            @foreach ($kriteria as $bb)
                                                <option value="{{ $bb->id }}">{{ $bb->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Nilai --}}
                                    <div>
                                        <x-input-label for="nilai_bk" :value="__('Nilai Bobot')" />
                                        <x-text-input id="nilai_bk" class="block mt-1 w-full" type="number"
                                            name="nilai_bk" :value="old('nilai_bk')" required autocomplete="nilai_bk"
                                            placeholder="Masukkan nilai sub kriteria" />
                                    </div>
                                    {{-- Submit Button --}}
                                    <div class="gap-6">
                                        <input type="submit" value="Tambah" class="btn btn-success">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan
