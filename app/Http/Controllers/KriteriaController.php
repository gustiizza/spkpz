<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KriteriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('kriteria')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::search($request->input('search'))
            ->orderBy('id', 'asc') // Sort the results as needed
            ->paginate($request->input('entries', 10));

        return view('kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kode_kriteria' => 'required|min:2|max:255',
            'nama' => 'required|min:5|max:255',
            'atribut' => 'required',
        ], [
            'kode_kriteria.required' => 'Mohon isi kode kriteria.',
            'kode_kriteria.min' => 'Kode kriteria harus memiliki setidaknya :min karakter.',
            'kode_kriteria.max' => 'Kode kriteria tidak boleh lebih dari :max karakter.',
            'kode_kriteria.unique' => 'Kode kriteria sudah digunakan.',
            'nama.required' => 'Mohon isi nama.',
            'nama.min' => 'Nama harus memiliki setidaknya :min karakter.',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'atribut.required' => 'Mohon isi atribut.',
        ]);
        $input = $request->all();
        Kriteria::create($input);
        return redirect('kriteria')->with('flash_message', 'Kriteria ditambahkan!!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit')->with('kriteria', $kriteria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kriteria = Kriteria::find($id);
        $input = $request->all();
        $kriteria->update($input);
        return redirect('kriteria')->with('flash_message', 'Kriteria diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $kriteria = Kriteria::find($id);

        if ($kriteria) {
            $kriteria->subKriteria()->delete();
            $kriteria->bobot()->delete();
            $kriteria->delete();
            return redirect('kriteria')->with('flash_message', 'Kriteria dihapus!!');
        }
        return redirect('kriteria')->with('flash_message', 'Kriteria dihapus!!');
    }
}
