@section('title', 'Edit Kriteria')
@can('view', App\Kriteria::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        {{ __('Edit Kriteria') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('kriteria.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('kriteria/' . $kriteria->id) }}" method="post" class="p-4">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">

                                    {!! csrf_field() !!}
                                    @method('PATCH')
                                    {{-- Kode Kriteria --}}
                                    <div>
                                        <x-input-label for="kode_kriteria" :value="__('Kode Kriteria')" />
                                        <x-text-input class="block mt-1 w-full" type="text" name="kode_kriteria"
                                            value="{{ $kriteria->kode_kriteria }}" placeholder="Masukkan kode kriteria" />
                                        <x-input-error :messages="$errors->get('kode_kriteria')" class="mt-2" />
                                    </div>

                                    {{-- Nama Kriteria --}}
                                    <div>
                                        <x-input-label for="nama" :value="__('Nama Kriteria')" />
                                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                            value="{{ $kriteria->nama }}" required autocomplete="nama"
                                            placeholder="Masukkan nama kriteria" />
                                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                    </div>

                                    {{-- Atribut --}}
                                    <div>
                                        <x-input-label :value="__('Atribut')" />
                                        <div class="mt-1 flex items-center">
                                            <label class="label cursor-pointer">
                                                <input type="radio" name="atribut" class="radio checked:bg-blue-500"
                                                    value="cost" required autocomplete="atribut">
                                            </label>
                                            <div class="label-text">Cost</div>
                                            <label class="label cursor-pointer">
                                                <input type="radio" name="atribut" class="radio checked:bg-blue-500"
                                                    value="benefit" required autocomplete="atribut">
                                            </label>
                                            <div class="label-text">Benefit</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- submit --}}
                                <div class="gap-6">
                                    <input type="submit" value="Edit" class="btn btn-success mt-4"></br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan
