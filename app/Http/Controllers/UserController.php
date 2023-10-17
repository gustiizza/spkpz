<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Use Scout's search method to perform a search
        $users = User::search($request->input('search'))
        ->orderBy('id', 'asc') // Sort the results as needed
        ->paginate($request->input('entries', 10));

        return view('pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $lowestId = User::min('id');
        
        // $input = $request->all();
        User::create([
            'id' => $lowestId - 1, // Set the new ID to be one less than the lowest available ID
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' =>$request->input('password'),
            'status' =>$request->input('status'),
        ]);
        return redirect('pengguna')->with('flash_message', 'Pengguna ditambahkan!!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $users = User::find($id);
        return view('pengguna.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        $input = $request->all();
        $users->update($input);
        return redirect('pengguna')->with('flash_message', 'Pengguna diubah!!');  
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
