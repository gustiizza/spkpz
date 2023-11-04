<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use Laravel\Scout\Searchable;

class LihatPenerimaController extends Controller
{

    public function __construct()
    {
        $this->middleware('penerima')->only(['index', 'show']);
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









    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }
}
