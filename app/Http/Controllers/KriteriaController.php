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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Use Scout's search method to perform a search
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
        Kriteria::destroy($id);
        return redirect('kriteria')->with('flash_message', 'Kriteria dihapus!!');
    }
}
