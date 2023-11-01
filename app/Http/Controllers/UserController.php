<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('pengguna')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::search($request->input('search'))
        ->orderBy('id', 'asc') // Sort the results as needed
        ->paginate($request->input('entries', 15));

        return view('pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kecamatan = Kecamatan::all();
        return view('pengguna.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        User::create($request->all());
        return redirect('pengguna')->with('flash_message', 'Pengguna ditambahkan!!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $users = User::find($id);
        $kecamatan = Kecamatan::all();
        return view('pengguna.edit', compact('users', 'kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        $input = $request->all();
        $users->update($input);
        return redirect()->route('pengguna.index')->with('flash_message', 'Pengguna diubah!!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        User::destroy($id);
        return redirect('pengguna')->with('flash_message', 'Pengguna dihapus!!'); 
    }
}
