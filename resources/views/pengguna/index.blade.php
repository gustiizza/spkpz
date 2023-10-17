<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              {{-- Content --}}
                <div class="px-6 pt-6 text-gray-900 font-semibold text-xl select-none">
                    {{ __("Daftar Pengguna") }}
                    <div class="flex justify-between pr-12 pt-4">
                      <a href="{{ route('pengguna.create') }}">
                        <button class="btn btn-success btn-sm">Tambah Pengguna</button>
                      </a>
                      {{-- <button class="btn btn-info btn-sm ">Sub Kriteria</button> --}}
                    </div>
                </div>  
              <div class="p-4 text-gray-900">
                <div class="overflow-x-auto">
                      <div class="px-4 pb-2 flex justify-between text-sm">
                        <div class="dropdown dropdown-top dropdown-end">
                          <form method="get">
                          <label for="entries">Show entries:</label>
                          <select name="entries" class="select select-bordered  fw-ull max-w-xs ml-2" id="entries" onchange="this.form.submit()">
                            <option value="10" @if(request('entries', 10) == 10) selected @endif>10</option>
                            <option value="25" @if(request('entries', 10) == 25) selected @endif>25</option>
                            <option value="50" @if(request('entries', 10) == 50) selected @endif>50</option>
                          </select>
                        </div>
                        <form method="get" action="{{ route('pengguna.index') }}">
                          <input type="text" name="search" placeholder="Cari" class="input input-bordered fw-ull max-w-xs" value="{{ request('search_param') }}">
                        </form>
                      </div>
                       <table class="table">
                          <!-- head -->
                          <thead>
                            <tr>
                              <th class="text-sm">No</th>
                              <th class="text-sm">Nama</th>
                              <th class="text-sm">Email</th>
                              <th class="text-sm">Role</th>
                              <th class="text-center text-sm">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($users as $user)
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $user->nama }}</td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @if ($user->status === 'op')
                                    Operator
                                @elseif ($user->status === 'dm')
                                    Decision Maker
                                @elseif ($user->status === 'rz')
                                    Relawan Zakat
                                @else
                                    Unknown Status
                                @endif
                              </td>
                              <td class="flex items-center justify-center">
                                <a href="{{ url('/pengguna/' . $user->id . '/edit') }}" title="Edit Pengguna"role="button" class="btn btn-info btn-sm">Edit</a>
                                  @if ($user->status !== 'op')
                                      <button type="button" class="btn btn-error btn-sm ml-1" onclick="showModal({{ $user->id }})">Hapus</button>
                                  @endif
                                  <dialog id="my_modal" class="modal">
                                      <div class="modal-box">
                                          <p class="py-4">Konfirmasi hapus data User ini?</p>
                                          <div class="modal-action">
                                              <form id="deleteForm" method="POST" action="{{ route('pengguna.destroy', $user->id) }}" style="margin-left: 10px;">
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
                                      function showModal(userId) {
                                          var modal = document.getElementById("my_modal");
                                          var deleteForm = document.getElementById("deleteForm");
                                          deleteForm.action = "{{ route('pengguna.destroy', '') }}" + '/' + userId; // Set the correct action URL
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
                    {{ $users->links() }}
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>