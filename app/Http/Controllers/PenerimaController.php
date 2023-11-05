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
use App\Models\Kriteria;
use App\Models\SubKriteria;

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
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::all();

        $nilai = [];

        // Encode the array as JSON
        $encodedData = json_encode($nilai);

        // Retrieve the "penerima" data
        $penerima = Penerima::where('kecamatan_id', $user->kecamatan_id)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate($entries);
        return view('penerima.index', compact('penerima', 'search', 'entries', 'kriteria'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::all();
        return view('penerima.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'nilai' => 'required|array',
        ]);
        $user = Auth::user();
        $kecamatanId = $user->kecamatan_id;

        $penerima = new Penerima();
        $penerima->nama = $request->input('nama');
        $penerima->alamat = $request->input('alamat');
        $penerima->kecamatan_id = $kecamatanId;

        // Convert the array to a JSON string
        $nilai = $request->input('nilai');

        // Assuming you have a Penerima model with a 'nilai' field

        $penerima->nilai = json_encode($nilai, JSON_FORCE_OBJECT); 
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
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::all();
        return view('penerima.edit', compact('penerima', 'kriteria', 'subkriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'nilai' => 'required|array',
        ]);

        $user = Auth::user();
        $kecamatanId = $user->kecamatan_id;

        $penerima = Penerima::find($id);

        if (!$penerima) {
            return redirect()->route('penerima.index')->with('error', 'Penerima not found');
        }

        $penerima->nama = $request->input('nama');
        $penerima->alamat = $request->input('alamat');
        $penerima->kecamatan_id = $kecamatanId;

        // Convert the array to a JSON string
        $nilai = $request->input('nilai');
        $penerima->nilai = json_encode($nilai, JSON_FORCE_OBJECT);

        $penerima->save();

        return redirect()->route('penerima.index')->with('success', 'Penerima updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Penerima::destroy($id);
        return redirect()->route('penerima.index')->with('flash_message', 'Penerima deleted successfully');
    }
}
