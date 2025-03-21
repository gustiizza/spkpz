@section('title', 'Kelola Pengguna')
@can('view', App\Pengguna::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                        <x-flash-message></x-flash-message>
                        {{ __('Daftar Pengguna') }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('pengguna.create') }}">
                                <button class="btn btn-success btn-sm">Tambah Pengguna</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <div class="px-4 pb-2 flex justify-between text-sm">
                                <form method="get">
                                    <label for="entries">Show entries:</label>
                                    <select name="entries" class="select select-bordered  fw-ull max-w-xs ml-2"
                                        id="entries" onchange="this.form.submit()">
                                        <option value="15" @if (request('entries', 10) == 15) selected @endif>15</option>
                                        <option value="25" @if (request('entries', 10) == 25) selected @endif>25</option>
                                        <option value="50" @if (request('entries', 10) == 50) selected @endif>50</option>
                                    </select>
                                </form>
                                <form method="get" action="{{ route('pengguna.index') }}" class="mr-auto pl-2">
                                    <input type="text" name="search" placeholder="Cari nama"
                                        class="input input-bordered" value="{{ request('search') }}">
                                </form>
                                <form method="get" action="{{ route('pengguna.index') }}">
                                    <select name="kecamatan_id" class="select select-bordered ml-2" id="kecamatan_id"
                                        onchange="this.form.submit()">
                                        <option value="" @if (!$selectedKecamatan) selected @endif>Kecamatan
                                            Relawan Zakat</option>
                                        @foreach ($kecamatan as $kecamatan)
                                            <option value="{{ $kecamatan->id }}"
                                                @if ($selectedKecamatan == $kecamatan->id) selected @endif>{{ $kecamatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th class="text-sm text-center">No</th>
                                        <th class="text-sm">Nama</th>
                                        <th class="text-sm">Email</th>
                                        <th class="text-sm">Role</th>
                                        <th class="text-center text-sm">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status === 'op')
                                                    Operator
                                                @elseif ($user->status === 'dm')
                                                    Decision Maker
                                                @elseif ($user->status == 'rz')
                                                    @if ($user->kecamatan && $user->kecamatan->nama)
                                                        Relawan Zakat-{{ $user->kecamatan->nama }}
                                                    @else
                                                        Relawan Zakat-<span class="text-red-600">Mohon tambahkan Kecamatan</span>
                                                    @endif
                                                @else
                                                    Unknown Status
                                                @endif
                                            </td>
                                            <td class="flex items-center justify-center">
                                                <a href="{{ url('/pengguna/' . $user->id . '/edit') }}"
                                                    title="Edit Pengguna"role="button" class="btn btn-info btn-sm">Edit</a>
                                                @if ($user->status !== 'op')
                                                    <button type="button" class="btn btn-error btn-sm ml-1"
                                                        onclick="showModal({{ $user->id }})">Hapus</button>
                                                @endif
                                                <dialog id="my_modal" class="modal">
                                                    <div class="modal-box">
                                                        <p class="py-4">Konfirmasi hapus data User ini?</p>
                                                        <div class="modal-action">
                                                            <form id="deleteForm" method="POST"
                                                                action="{{ route('pengguna.destroy', $user->id) }}"
                                                                style="margin-left: 10px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-error">Yes</button>
                                                            </form>
                                                            <button type="button" class="btn btn-info"
                                                                onclick="closeModal()">No</button>
                                                        </div>
                                                    </div>
                                                </dialog>
                                                <script>
                                                    function showModal(userId) {
                                                        var modal = document.getElementById("my_modal");
                                                        var deleteForm = document.getElementById("deleteForm");
                                                        deleteForm.action = "{{ route('pengguna.destroy', '') }}" + '/' + userId; 
                                                        modal.showModal();
                                                    }

                                                    function closeModal() {
                                                        var modal = document.getElementById("my_modal");
                                                        modal.close();
                                                    }
                                                </script>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan