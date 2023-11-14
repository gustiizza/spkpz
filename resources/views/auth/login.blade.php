<x-guest-layout>
    @section('title', 'Login')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mt-2 mb-5 text-center">
            <h1 class="font-black select-none border-b-2 pb-4">Sistem Pendukung Keputusan Penentuan Penerima
                Zakat<br>BAZNAS Kabupaten Mempawah</h1>
            <h2 class="font-black pt-2">Login</h2>
        </div>
        <div class="select-none">
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama"
                class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full"
                type="text" name="nama" :value="old('nama')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 select-none">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-3 bg-primary hover:bg-neutral select-none">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
