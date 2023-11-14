<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Penerima;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Laravel\Scout\Searchable;
use App\Models\Kriteria;
use App\Models\NilaiPenerima;
use App\Models\SubKriteria;

class LihatPenerimaController extends Controller
{

    public function __construct()
    {
        $this->middleware('lihatpenerima')->only(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedKecamatan = $request->input('kecamatan_id');
        $search = $request->input('search');
        $entries = $request->input('entries', 10);
        $kecamatan = Kecamatan::all();
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::all();
        $bobot = Bobot::all();
        $nilai = NilaiPenerima::all();


        $penerima = Penerima::when($selectedKecamatan, function ($query) use ($selectedKecamatan) {
            return $query->where('kecamatan_id', $selectedKecamatan);
        })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('alamat', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('id', 'asc')
            ->paginate($entries)
            ->withQueryString();

        return view('penerima.lihat', compact('penerima', 'kecamatan', 'selectedKecamatan', 'search', 'kriteria', 'nilai'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }
}
