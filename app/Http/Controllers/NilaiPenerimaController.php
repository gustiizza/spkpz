<?php

namespace App\Http\Controllers;


use App\Models\Kriteria;
use App\Models\NilaiPenerima;
use App\Models\Penerima;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewView;

class NilaiPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nilaipenerima = NilaiPenerima::search($request->input('search'))
            ->orderBy('id', 'asc') // Sort the results as needed
            ->paginate($request->input('entries', 10));
        return view('nilaipenerima.index', compact('nilaipenerima'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penerima = Penerima::all();
        $kriteria = Kriteria::all();
        $nilaipenerima = NilaiPenerima::all();
        return view('subkriteria.create', compact('kriteria', 'penerima', 'nilaipenerima'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        NilaiPenerima::create($request->all());
        return redirect()->route('penerima.index')->with('flash_message', '');
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiPenerima $nilaiPenerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id): View
    {
        $nilaipenerima = NilaiPenerima::all($id);
        $penerima = Penerima::all();
        $kriteria = Kriteria::all();
        return view('penerima', compact('kriteria', 'penerima', 'nilaipenerima'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nilaipenerima = NilaiPenerima::with('kriteria', 'penerima')->find($id);
        $input = $request->all();
        $nilaipenerima->update($input);
        $nilaipenerima->save();

        return redirect()->route('penerima.index')->with('flash_message', '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        NilaiPenerima::destroy($id);
        return redirect()->route('penerima.index')->with('flash_message', '');
    }
}
