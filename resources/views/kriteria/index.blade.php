@section('title','Kelola Kriteria')
@can('view', App\Kriteria::class)
<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Kriteria") }}
                    <div class="flex justify-between pr-12 pt-4">
                      <a href="{{ route('kriteria.create') }}">
                        <button class="btn btn-success btn-sm">Tambah Kriteria</button>
                      </a>
                    </div>
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                       <table class="table">
                          <!-- head -->
                          <thead>
                            <tr>
                              <th class="text-sm text-center">No</th>
                              <th class="text-sm text-center">Kode Kriteria</th>
                              <th class="text-sm">Nama Kriteria</th>
                              <th class="text-sm">Atribut</th>
                              <th class="text-center text-sm">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($kriteria as $krtr)
                           <tr>
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $krtr->kode_kriteria }}</td>
                              <td>{{ $krtr->nama }}</td>
                              <td>{{ $krtr->atribut }}</td>
                              <td class="flex items-center justify-center">
                                <a href="{{ url('/kriteria/' . $krtr->id . '/edit') }}" title="Edit Kriteria"role="button" class="btn btn-info btn-sm">Edit</a>
                                      <button type="button" class="btn btn-error btn-sm ml-1" onclick="showModal({{ $krtr->id }})">Hapus</button>
                                  <dialog id="my_modal" class="modal">
                                      <div class="modal-box">
                                          <p class="py-4">Konfirmasi hapus data Kriteria ini?</p>
                                          <div class="modal-action">
                                              <form id="deleteForm" method="POST" action="{{ route('kriteria.destroy', $krtr->id) }}" style="margin-left: 10px;">
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
                                      function showModal(kriteriaId) {
                                          var modal = document.getElementById("my_modal");
                                          var deleteForm = document.getElementById("deleteForm");
                                          deleteForm.action = "{{ route('kriteria.destroy', '') }}" + '/' + kriteriaId; // Set the correct action URL
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
                    {{ $kriteria->links() }}
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endcan