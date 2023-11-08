<?php

namespace App\Http\Controllers;

use App\Models\Perhitungan;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Bobot;
use App\Models\Penerima;

class PerhitunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('perhitungan')->only(['index']);
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

        $nilai = [];

        // Encode the array as JSON
        $encodedData = json_encode($nilai);
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

        return view('penerima.lihat', compact('penerima', 'kecamatan', 'selectedKecamatan', 'search'));
    }
}
