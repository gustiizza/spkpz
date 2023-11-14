<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'kriteria_id' => 'unique:bobot',
            'nilai_bk' => [
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $totalNilaiBK = Bobot::where('nilai_bk', $request->input('nilai_bk'))->sum('nilai_bk');
                    $totalNilaiBKSemuaKriteria = Bobot::sum('nilai_bk');
                    if ($totalNilaiBK + $value > 100) {
                        $fail('Nilai Bobot tidak boleh lebih dari 100.');
                    }
                    if ($totalNilaiBKSemuaKriteria + $value > 100) {
                        $fail('Total Nilai Bobot saat ini ' . $totalNilaiBKSemuaKriteria . ', inputan nilai Bobot anda melebihi 100.');
                    }
                },
            ],
        ], [
            'kriteria_id.unique' => 'Kriteria sudah diambil.',
        ]);

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
    public function update(Request $request, $id): RedirectResponse
    {
        $bobot = Bobot::with('kriteria')->find($id);
        $request->validate([
            'nilai_bk' => [
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    $totalNilaiBK = Bobot::where('nilai_bk', $request->input('nilai_bk'))->sum('nilai_bk');
                    $totalNilaiBKSemuaKriteria = Bobot::sum('nilai_bk');
                    if ($totalNilaiBK + $value > 100) {
                        $fail('Nilai Bobot tidak boleh lebih dari 100.');
                    }
                    if ($totalNilaiBKSemuaKriteria > 100) {
                        $fail('Total Nilai Bobot saat ini ' . $totalNilaiBKSemuaKriteria . ', inputan nilai Bobot anda melebihi 100.');
                    }
                },
            ],
        ]);

        $input = $request->all();
        $bobot->update($input);

        return redirect()->route('bobot.index')->with('flash_message', 'Bobot berhasil diupdate');
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
