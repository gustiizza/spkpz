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
        $entries = $request->input('entries', 100);
        $kecamatan = Kecamatan::all();
        $kriteria = Kriteria::all();
        $subkriteria = SubKriteria::all();
        $bobot = Bobot::all();

        $penerima = Penerima::when($selectedKecamatan, function ($query) use ($selectedKecamatan) {
            return $query->where('kecamatan_id', $selectedKecamatan);
        })
            ->orderBy('id', 'asc')
            ->paginate($entries)
            ->withQueryString();

        $sumOfWeights = $bobot->sum('nilai_bk');

        $normalizedWeights = $bobot->map(function ($bb) use ($sumOfWeights) {
            $normalizedWeight = ($sumOfWeights != 0) ? $bb->nilai_bk / $sumOfWeights : 0;

            if ($bb->kriteria->atribut == 'cost') {
                $normalizedWeight = -1 * $normalizedWeight;
            }
            return [
                'kriteria_id' => $bb->kriteria->id,
                'normalized_weight' => $normalizedWeight,
            ];
        })->pluck('normalized_weight', 'kriteria_id');

        $vectorS = $penerima->map(function ($pnm) use ($kriteria, $normalizedWeights) {
            $product = 1;
            foreach ($kriteria as $krit) {
                $nilaiPenerima = $pnm->nilaiPenerima->where('kriteria_id', $krit->id)->first();
                if ($nilaiPenerima && $nilaiPenerima->subkriteria) {
                    $nilaiSk = $nilaiPenerima->subkriteria->nilai_sk;
                    $product *= pow($nilaiSk, $normalizedWeights[$krit->id]);
                }
            }
            return [
                'id' => $pnm->id,
                'vector_s' => $product,
            ];
        })->pluck('vector_s', 'id');

        //  vector V
        $vectorV = $vectorS->map(function ($value, $key) use ($vectorS) {
            $normalizedValue = ($vectorS->sum() != 0) ? $value / $vectorS->sum() : 0;
            return [
                'id' => $key,
                'vector_v' => $normalizedValue,
            ];
        })->pluck('vector_v', 'id');
        return view('perhitungan.index', compact('penerima', 'kecamatan', 'selectedKecamatan', 'kriteria', 'bobot', 'normalizedWeights', 'vectorS', 'vectorV'));
    }
}
