<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Kriteria;
use App\Models\NilaiPenerima;
use App\Models\Penerima;
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

        $kriteria = Kriteria::all();
        $nilai = NilaiPenerima::all();
        $subkriteria = SubKriteria::all();

        // Retrieve the "penerima" data
        $penerima = Penerima::where('kecamatan_id', $user->kecamatan_id)
            ->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate($entries);
        return view('penerima.index', compact('penerima', 'search', 'entries', 'kriteria', 'nilai'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('penerima.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string', 'alamat' => 'required|string', 'nilai.*' => 'required',
        ]);

        $user = Auth::user();
        $kecamatanId = $user->kecamatan_id;

        // Create a new Penerima instance
        $penerima = new Penerima([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'kecamatan_id' => $kecamatanId,
        ]);
        $penerima->save();
        // Store Nilai_penerima records
        foreach ($validatedData['nilai'] as $kriteriaId => $nilai) {
            NilaiPenerima::create([
                'penerima_id' => $penerima->id,
                'kriteria_id' => $kriteriaId,
                'nilai' => $nilai,
            ]);
        }

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
        return view('penerima.edit', compact('penerima', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'nilai.*' => 'required',
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

        // Clear existing NilaiPenerima records for this penerima
        $penerima->nilaiPenerima()->delete();

        // Store updated NilaiPenerima records
        foreach ($request->input('nilai') as $kriteriaId => $nilai) {
            $penerima->nilaiPenerima()->create([
                'kriteria_id' => $kriteriaId,
                'nilai' => $nilai,
            ]);
        }

        return redirect()->route('penerima.index')->with('success', 'Penerima updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Find the Penerima by its ID
        $penerima = Penerima::find($id);

        if (!$penerima) {
            return redirect()->route('penerima.index')->with('error', 'Penerima not found');
        }
        $penerima->delete();
        return redirect()->route('penerima.index')->with('flash_message', 'Penerima deleted successfully');
    }
}
