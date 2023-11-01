<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BobotController extends Controller
{
    public function __construct()
    {
        $this->middleware('bobot')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bobot = Bobot::search($request->input('search'))
            ->orderBy('id', 'asc')
            ->paginate($request->input('entries', 10));
        return view('bobot.index', compact('bobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('bobot.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Bobot::create($input);
        return redirect()->route('bobot.index')->with('flash_message', 'Bobot berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bobot $bobot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id): View
    {
        $bobot = Bobot::find($id);
        $kriteria = Kriteria::all();
        return view('bobot.edit', compact('bobot', 'kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bobot = Bobot::with('kriteria')->find($id);
        $input = $request->all();
        $bobot->update($input);
        $bobot->save();

        // Redirect to a success page or any other appropriate action
        return redirect()->route('bobot.index')->with('flash_message', 'Bobot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bobot::destroy($id);
        return redirect()->route('bobot.index')->with('flash_message', 'Bobot berhasil dihapus!');
    }
}
