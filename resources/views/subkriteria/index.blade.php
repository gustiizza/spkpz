@section('title','Kelola Sub Kriteria')
@can('view', App\SubKriteria::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Sub Kriteria") }}
                    <div class="flex justify-between pr-12 pt-4">
                      <a href="{{ route('subkriteria.create') }}">
                        <button class="btn btn-success btn-sm">Tambah Sub Kriteria</button>
                      </a>
                    </div>
                </div>  
              <div class="m-4 text-gray-900">
                <div class="overflow-x-auto mx-8">
                    @foreach ($subkriteria->groupBy('kriteria_id') as $kriteriaId => $kriteriaSubkriteria)
                    @php
                        $kriteria = $kriteriaSubkriteria->first()->kriteria;
                    @endphp
                    <h1 class=" mt-4">{{ $kriteria->kode_kriteria }} : {{ $kriteria->nama }}</h1>
                    <table class="table md:table-fixed">
                        <!-- head -->
                        <thead>
                            <tr>
                              <th class="text-sm text-center">No</th>
                              <th class="text-sm">Sub Kriteria</th>
                              <th class="text-sm text-center">Nilai</th>
                              <th class="text-sm text-center ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteriaSubkriteria as $sk)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $sk->nama_sub_kriteria }}</td>
                                    <td class="text-center">{{ $sk->nilai_sk }}</td>
                                    <td class="flex justify-center">
                                    <a href="{{ url('/subkriteria/' . $sk->id . '/edit') }}" title="Edit Sub Kriteria" role="button" class="btn btn-info btn-sm">Edit</a>
                                    <button type="button" class="btn btn-error btn-sm ml-1" onclick="showModal({{ $sk->id }})">Hapus</button>
                                    <dialog id="my_modal_{{ $sk->id }}" class="modal">
                                        <div class="modal-box">
                                            <p class="py-4">Konfirmasi hapus data Sub Kriteria ini?</p>
                                            <div class="modal-action">
                                                <form id="deleteForm" method="POST" action="{{ route('subkriteria.destroy', $sk->id) }}" style="margin-left: 10px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-error">Yes</button>
                                                </form>
                                                <button type="button" class="btn btn-info" onclick="closeModal({{ $sk->id }})">No</button>
                                            </div>
                                        </div>
                                        </dialog>
                                        <script>
                                            function showModal(subkriteriaId) {
                                                var modal = document.getElementById("my_modal_" + subkriteriaId);
                                                var deleteForm = document.getElementById("deleteForm");
                                                deleteForm.action = "{{ route('subkriteria.destroy', '') }}" + '/' + subkriteriaId;
                                                modal.showModal();
                                            }
                                            function closeModal(subkriteriaId) {
                                                var modal = document.getElementById("my_modal_" + subkriteriaId);
                                                modal.close();
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="divider"></div> 
                @endforeach
                </div>
                {{-- <div class="mt-4">
                    {{ $subkriteria->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
