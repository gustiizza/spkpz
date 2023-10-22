@section('title','Tambah Pengguna')
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl">
                    {{ __("Tambah Pengguna") }}
                    <div class="flex justify-between pr-12 pt-4">
                        <a href="{{ route('pengguna.index') }}">
                            <button class="btn btn-success btn-sm">Kembali</button>
                        </a>
                      {{-- <button class="btn btn-info btn-sm ">Sub Kriteria</button> --}}
                    </div>
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                    <form action="{{ url('pengguna') }}" method="POST" class="p-4">
                        <div class="grid grid-cols-3 grid-rows-2 gap-6">
                                @csrf
                                    {{-- Nama --}}
                                    <div>
                                    <x-input-label for="nama" :value="__('Nama')" />
                                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" placeholder="Masukkan nama"/>
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                    </div>
                                    
                                    {{-- Email --}}
                                    <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Masukkan email"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    {{-- Status --}}                                    
                                    <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" class="select select-bordered block mt-1 w-full " name="status" required autofocus autocomplete="status">
                                        <option disabled selected>Pilih Status</option>
                                        {{-- <option value="op">Operator</option> --}}
                                        <option value="dm">Decision Maker</option>
                                        <option value="rz">Relawan Zakat</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>

                                    {{-- Password --}}
                                    <div>
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password"
                                                    placeholder="Masukkan password"/>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    {{-- confirm password --}}
                                    <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Masukkan kembali password"/>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <input type="submit" value="Tambah" class="btn btn-success mt-4"></br>                        
                            </div>
                        </div>                     
                        {{-- submit --}}
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>