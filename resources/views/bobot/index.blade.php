@section('title','Kelola Bobot')
@can('view', App\Bobot::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Bobot") }}
                    <div class="flex justify-between pr-12 pt-4">
                      <a href="{{ route('bobot.create') }}">
                        <button class="btn btn-success btn-sm">Tambah Bobot</button>
                      </a>
                    </div>
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">

                       <table class="table">
                          <!-- head -->
                          <thead>
                            <tr>
                              <th class="text-sm">No</th>
                              <th class="text-sm">Kode</th>
                              <th class="text-sm">Nama Kriteria</th>
                              <th class="text-sm">Atribut</th>
                              <th class="text-center text-sm">Bobot</th>
                              <th class="text-center text-sm">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($bobot as $bb)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $bb->kriteria->kode_kriteria }}</td>
                              <td>{{ $bb->kriteria->nama }}</td>
                              <td>{{ $bb->kriteria->atribut }}</td>
                              <td class="text-center">{{ $bb->nilai_bk }}</td>
                              <td class="flex items-center justify-center">
                                <a href="{{ url('/bobot/' . $bb->id . '/edit') }}" title="Edit Bobot"role="button" class="btn btn-info btn-sm">Edit</a>
                                {{-- <button type="button" class="btn btn-error btn-sm ml-1" onclick="showModal({{ $bb->id }})">Hapus</button>
                                  <dialog id="my_modal" class="modal">
                                    <div class="modal-box">
                                      <p class="py-4">Konfirmasi hapus data Bobot ini?
                                      </p>
                                      <div class="modal-action">
                                        <form id="deleteForm" method="POST" action="{{ route('bobot.destroy', $bb->id) }}" style="margin-left: 10px;">
                                          <!-- if there is a button in the form, it will close the modal -->
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-error">Yes</button>
                                        </form>
                                        <button type="button" class="btn btn-info" onclick="closeModal()">No</button>
                                      </div>
                                    </div>
                                  </dialog>
                                  <script>
                                  function showModal(bobotId) {
                                    var modal = document.getElementById("my_modal");
                                    var deleteForm = document.getElementById("deleteForm");
                                    deleteForm.action = "{{ route('bobot.destroy', '') }}" + '/' + bobotId; // Set the correct action URL
                                    modal.showModal();
                                  }
                                  function closeModal() {
                                      var modal = document.getElementById("my_modal");
                                      modal.close();
                                  }
                                  </script> --}}
                              </td>
                           </tr>
                           @endforeach
                            <tr>
                              <th class="text-sm"></th>
                              <th class="text-sm"></th>
                              <th class="text-sm">Total Bobot</th>
                              <th class="text-sm"></th>
                              <th class="text-sm text-center">{{ $bobot->sum('nilai_bk') }}</th>
                              <th class="text-sm"></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    <div class="mt-4">
                    {{ $bobot->links() }}
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan
