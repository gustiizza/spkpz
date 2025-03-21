@section('title', 'Tambah Kriteria')
@can('view', App\Kriteria::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        {{ __('Tambah Kriteria') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('kriteria.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('kriteria') }}" method="POST" class="p-4">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
                                    @csrf
                                    {{-- Kode Kriteria --}}
                                    <div>
                                        <x-input-label for="kode_kriteria" :value="__('Kode Kriteria')" />
                                        <x-text-input id="kode_Kriteria" class="block mt-1 w-full" type="text"
                                            name="kode_kriteria" :value="old('nama')" required autofocus autocomplete="nama"
                                            placeholder="Masukkan kode kriteria" />
                                        <label class="label">
                                            <span class="label-text-alt">contoh: K1</span>
                                        </label>
                                        <x-input-error :messages="$errors->get('kode_kriteria')" class="mt-2" />
                                    </div>

                                    {{-- Nama Kriteria --}}
                                    <div>
                                        <x-input-label for="nama" :value="__('Nama Kriteria')" />
                                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                            :value="old('nama')" required autocomplete="nama"
                                            placeholder="Masukkan nama kriteria" />
                                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                    </div>
                                    {{-- Atribut --}}
                                    <div>
                                        <x-input-label :value="__('Atribut')" />
                                        <div class="mt-1 flex items-center">
                                            <label class="label cursor-pointer">
                                                <input type="radio" name="atribut" class="radio checked:bg-blue-500"
                                                    value="cost" required autofocus autocomplete="atribut">
                                            </label>
                                            <div class="label-text">Cost</div>
                                            <label class="label cursor-pointer">
                                                <input type="radio" name="atribut" class="radio checked:bg-blue-500"
                                                    value="benefit" required autofocus autocomplete="atribut">
                                            </label>
                                            <div class="label-text">Benefit</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- submit --}}
                                <div>
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