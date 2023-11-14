<?php

namespace App\Http\Controllers;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use App\Http\Requests\StoreSubKriteriaRequest;
use App\Http\Requests\UpdateSubKriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class SubKriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('subkriteria')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subkriteria = SubKriteria::search($request->input('search'))
            ->orderBy('kriteria_id',  'asc')->orderBy('nilai_sk', 'asc')
        ->paginate($request->input('entries', 15));
        return view('subkriteria.index', compact('subkriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('subkriteria.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        SubKriteria::create($request->all());
        return redirect()->route('subkriteria.index')->with('flash_message', 'SubKriteria created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $id)
    {
        $subkriteria = SubKriteria::find($id);
        if (!$subkriteria) {
            return redirect()->route('subkriteria.index')->with('error_message', 'SubKriteria not found');
        }
        $kriteria = $subkriteria->kriteria;
        return view('subkriteria.show', compact('subkriteria', 'kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id): View
    {
        $subkriteria = SubKriteria::find($id);
        $kriteria = Kriteria::all();
        return view('subkriteria.edit', compact('subkriteria', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.        
     */
    public function update(Request $request, string $id)
    {
        $subkriteria = SubKriteria::with('kriteria')->find($id);
        $input = $request->all();
        $subkriteria->update($input);
        $subkriteria->save();

        return redirect()->route('subkriteria.index')->with('flash_message', 'SubKriteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        SubKriteria::destroy($id);
        return redirect()->route('subkriteria.index')->with('flash_message', 'SubKriteria deleted successfully');
    }
}
