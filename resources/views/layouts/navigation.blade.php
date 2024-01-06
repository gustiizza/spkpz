<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('pengguna.index') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class=" h-12 w-auto" />
                    </a>
                </div>
                <!-- Operator -->
                @if (Auth::user()->status === 'op')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('pengguna.index')" :active="request()->routeIs('pengguna*')">
                            {{ __('Kelola Pengguna') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('kriteria.index')" :active="request()->routeIs('kriteria*')">
                            {{ __('Kelola Kriteria') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('subkriteria.index')" :active="request()->routeIs('subkriteria*')">
                            {{ __('Kelola Sub Kriteria') }}
                        </x-nav-link>
                    </div>


                    {{-- DM --}}
                @elseif (Auth::user()->status === 'dm')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('bobot.index')" :active="request()->routeIs('bobot*')">
                            {{ __('Kelola Bobot Kriteria') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('penerima.lihat')" :active="request()->routeIs('penerima*')">
                            {{ __('Lihat Penerima per Kecamatan') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('perhitungan.index')" :active="request()->routeIs('perhitungan.index')">
                            {{ __('Perhitungan') }}
                        </x-nav-link>
                    </div>


                    <!-- Relawan Zakat -->
                @elseif (Auth::user()->status === 'rz')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('penerima.index')" :active="request()->routeIs('penerima*')">
                            {{ __('Kelola Penerima') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('perhitungan.hasil')" :active="request()->routeIs('perhitungan.hasil')">
                        {{ __('Lihat Hasil Perhitungan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nama }} @isset(Auth::user()->kecamatan->nama)
                                    - {{ Auth::user()->kecamatan->nama }}
                                @endisset
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->nama }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200 px-4">
                @if (Auth::user()->status === 'op')
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('pengguna.index')" :active="request()->routeIs('pengguna*')">
                            {{ __('Kelola Pengguna') }}
                        </x-nav-link>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('kriteria.index')" :active="request()->routeIs('kriteria*')">
                            {{ __('Kelola Kriteria') }}
                        </x-nav-link>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('subkriteria.index')" :active="request()->routeIs('subkriteria*')">
                            {{ __('Kelola Sub Kriteria') }}
                        </x-nav-link>
                    </div>

                    {{-- DM --}}
                @elseif (Auth::user()->status === 'dm')
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('bobot.index')" :active="request()->routeIs('bobot*')">
                            {{ __('Kelola Bobot Kriteria') }}
                        </x-nav-link>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('penerima.lihat')" :active="request()->routeIs('penerima*')">
                            {{ __('Lihat Penerima per Kecamatan') }}
                        </x-nav-link>
                    </div>
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('perhitungan.index')" :active="request()->routeIs('perhitungan.index')">
                            {{ __('Perhitungan') }}
                        </x-nav-link>
                    </div>

                    <!-- Relawan Zakat -->
                @elseif (Auth::user()->status === 'rz')
                    <div class="pt-2 pb-3 space-y-1">
                        <x-nav-link :href="route('penerima.index')" :active="request()->routeIs('penerima*')">
                            {{ __('Kelola Penerima') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="pt-2 pb-3 space-y-1">
                    <x-nav-link :href="route('perhitungan.hasil')" :active="request()->routeIs('perhitungan.hasil')">
                        {{ __('Lihat Hasil Perhitungan') }}
                    </x-nav-link>
                </div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
