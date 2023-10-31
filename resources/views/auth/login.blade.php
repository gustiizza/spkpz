<x-guest-layout>
@section('title','Login')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <!-- Email Address -->
        <div class="mt-2 mb-5 text-center">
            <h1 class="font-black select-none border-b-2 pb-4">Sistem Pendukung Keputusan Penentuan Penerima Zakat<br>pada BAZNAS Kabupaten Mempawah</h1>
            <h2 class="font-black pt-2">Login</h2>
        </div>
        <div class="select-none">
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 select-none">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4 select-none">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-center mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="ml-3 bg-primary hover:bg-neutral select-none">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
