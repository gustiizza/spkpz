<?php

namespace App\Http\Controllers;

use App\Models\NilaiPenerima;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PenerimaController extends Controller
{

    public function __construct()
    {
        $this->middleware('penerima')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10);

        // Get the currently authenticated user
        $user = Auth::user();

        // Query the "penerima" table to retrieve records with the same "kecamatan_id" as the user and match the search term
        $penerima = Penerima::where('kecamatan', $user->kecamatan_id)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate($entries);

        return view('penerima.index', compact('penerima', 'search', 'entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerima = Penerima::all();
        // $nilaipenerima = NilaiPenerima::all();
        return view('penerima.create', compact('penerima'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $kecamatanId = $user->kecamatan_id;

        // Create a new Penerima record and set its attributes
        $penerima = new Penerima;
        $penerima->nama = $request->input('nama');
        $penerima->alamat = $request->input('alamat');
        $penerima->kecamatan = $kecamatanId; // Set "kecamatan_id" from the currently logged-in user
        $penerima->save();
        return redirect()->route('penerima.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id): View
    {
        $penerima = Penerima::find($id);
        return view('penerima.edit', compact('penerima'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penerima = Penerima::find($id);
        $input = $request->all();
        $penerima->update($input);
        return redirect()->route('penerima.index')->with('flash_message', 'Penerima updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerima $penerima): RedirectResponse
    {
        $penerima->delete();
        return redirect()->route('penerima.index')->with('flash_message', 'Penerima deleted successfully');
    }
}
