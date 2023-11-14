@section('title', 'Tambah Pengguna')
@can('view', App\Pengguna::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                        {{ __('Tambah Pengguna') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('pengguna.index') }}">
                                <button class="btn btn-secondary btn-sm">Kembali</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <form action="{{ url('pengguna') }}" method="POST" class="p-4">
                                <div class="grid grid-cols-3 grid-rows-2 gap-4">
                                    @csrf
                                    {{-- Nama --}}
                                    <div>
                                        <x-input-label for="nama" :value="__('Nama')" />
                                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                            :value="old('nama')" required autofocus autocomplete="nama"
                                            placeholder="Masukkan nama" />
                                    </div>

                                    {{-- Password --}}
                                    <div>
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password"
                                            placeholder="Masukkan password" />
                                    </div>

                                    {{-- Confirm password --}}
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Masukkan kembali password" />
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block w-full" type="email" name="email"
                                            :value="old('email')" required autocomplete="email" placeholder="Masukkan email" />
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <x-input-label :value="__('Status')" />
                                        <div class="flex items-center">
                                            <label class="label cursor-pointer">
                                                <input type="radio" name="status" class="radio checked:bg-blue-500"
                                                    value="dm" required autofocus autocomplete="status" />
                                            </label>
                                            <div class="label-text">Decision Maker</div>

                                            <label class="label cursor-pointer ml-2">
                                                <input type="radio" name="status" class="radio checked:bg-blue-500"
                                                    value="rz" required autofocus autocomplete="status" />
                                            </label>
                                            <div class="label-text">Relawan Zakat</div>
                                        </div>
                                    </div>

                                    {{-- Kecamatan --}}
                                    <div>
                                        <x-input-label for="kecamatan_id" :value="__('Kecamatan')" />
                                        <select id="kecamatan_id" class="select select-bordered block mt-1 w-full"
                                            name="kecamatan_id" required autocomplete="kecamatan_id">
                                            <option disabled selected>Pilih Kecamatan</option>
                                            @foreach ($kecamatan as $kcmtn)
                                                <option value="{{ $kcmtn->id }}">{{ $kcmtn->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="label-text-alt">Decision Maker tidak perlu pilih kecamatan</span>
                                    </div>
                                </div>
                                {{-- Submit --}}
                                <input type="submit" value="Tambah" class="btn btn-success mt-4" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan