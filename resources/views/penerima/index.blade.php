@section('title', 'Kelola Penerima')
@can('view', App\Penerima::class)
    <x-app-layout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Content --}}
                    <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                        <x-error-info />
                        {{ __('Daftar Penerima Kecamatan') }} {{ Auth::user()->kecamatan->nama }}
                        <div class="flex justify-between pr-12 pt-4">
                            <a href="{{ route('penerima.create') }}">
                                <button class="btn btn-success btn-sm">Tambah penerima</button>
                            </a>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900">
                        <div class="overflow-x-auto">
                            <div class="pr-4 pl-4 pb-2 flex justify-between text-sm">
                                <div class="dropdown dropdown-top dropdown-end">
                                    <form method="get">
                                        <label for="entries">Show entries:</label>
                                        <select name="entries" class="select select-bordered  fw-ull max-w-xs ml-2"
                                            id="entries" onchange="this.form.submit()">
                                            <option value="10" @if (request('entries', 10) == 10) selected @endif>10
                                            </option>
                                            <option value="25" @if (request('entries', 10) == 25) selected @endif>25
                                            </option>
                                            <option value="50" @if (request('entries', 10) == 50) selected @endif>50
                                            </option>
                                        </select>
                                    </form>
                                </div>
                                <form method="get" action="{{ route('penerima.index') }}">
                                    <input type="text" name="search" placeholder="Cari"
                                        class="input input-bordered fw-ull max-w-xs" value="{{ request('search') }}">
                                </form>
                            </div>
                            <div class="text-gray-900">
                                <div class="overflow-x-auto">
                                    <table class="table table-xs">
                                        <!-- head -->
                                        <thead style="white-space: wrap;hite-space-collapse:initial;text-wrap: wrap;">
                                            <tr class="bg-base-200">
                                                <th class="text-sm text-center align-middle">No</th>
                                                <th class="text-sm">Nama</th>
                                                <th class="text-sm">Alamat</th>
                                                @foreach ($kriteria as $krit)
                                                    <th class="text-sm text-center">{{ $krit->nama }}</th>
                                                @endforeach
                                                <th class="text-center text-sm">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penerima as $pnm)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $pnm->nama }}</td>
                                                    <td>{{ $pnm->alamat }}</td>
                                                    @foreach ($kriteria as $krit)
                                                        <td class="text-center">
                                                            @foreach ($pnm->nilaiPenerima->where('kriteria_id', $krit->id) as $nilai)
                                                                {{ $nilai->subkriteria->nama_sub_kriteria }}
                                                            @endforeach
                                                        </td>
                                                    @endforeach
                                                    {{-- Edit --}}
                                                    <td class="flex items-center justify-center py-4">
                                                        <a href="{{ url('/penerima/' . $pnm->id . '/edit') }}"title="Edit penerima"
                                                            role="button"
                                                            class="btn btn-info btn-sm items-center justify-center">Edit</a>
                                                        {{-- Hapups --}}
                                                        <button type="button"
                                                            class="btn btn-error btn-sm ml-1 items-center justify-center"
                                                            onclick="showModal({{ $pnm->id }})">Hapus</button>
                                                        <dialog id="my_modal" class="modal">
                                                            <div class="modal-box">
                                                                <p class="py-4">Konfirmasi hapus data User ini?</p>
                                                                <div class="modal-action">
                                                                    <form id="deleteForm" method="POST"
                                                                        action="{{ route('penerima.destroy', $pnm->id) }}"
                                                                        style="margin-left: 10px;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-error">Yes</button>
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
                                                                deleteForm.action = "{{ route('penerima.destroy', '') }}" + '/' + userId;
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
                                    {{ $penerima->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan
