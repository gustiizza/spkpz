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
        $kecamatan = Kecamatan::all();

        $penerima = Penerima::when($selectedKecamatan, function ($query) use ($selectedKecamatan) {
            return $query->where('kecamatan_id', $selectedKecamatan);
        })
            ->orderBy('id', 'asc')
            ->paginate($request->input('entries', 15));


        return view('penerima.lihat', compact('penerima', 'kecamatan', 'selectedKecamatan'));
    }







    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }
}
