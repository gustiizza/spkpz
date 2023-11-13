<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Bobot;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasil')->only(['index', 'cetak']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedKecamatan = $request->input('kecamatan_id');
        $entries = $request->input('entries', 1000);

        // Retrieve data from models
        $kecamatan = Kecamatan::all();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all();

        $penerima = $this->getPenerimaData($user, $selectedKecamatan, $entries);

        // Calculate weighted product using the Weighted Product Method
        list($normalizedWeights, $vectorS, $vectorV) = $this->calculateWeightedProduct($penerima, $kriteria, $bobot);

        // Sort $penerima based on vectorV in descending order
        $penerima = $this->sortPenerimaByVectorV($penerima, $vectorV);

        return view('perhitungan.hasil', compact('penerima', 'kecamatan', 'selectedKecamatan', 'kriteria', 'bobot', 'vectorV'));
    }

    public function cetak(Request $request)
    {
        $user = Auth::user();
        $selectedKecamatan = $request->input('kecamatan_id');
        $entries = $request->input('entries', 1000);

        // Retrieve data from models
        $kecamatan = Kecamatan::all();
        $kriteria = Kriteria::all();
        $bobot = Bobot::all();

        $penerima = $this->getPenerimaData($user, $selectedKecamatan, $entries);

        // Calculate weighted product using the Weighted Product Method
        list($normalizedWeights, $vectorS, $vectorV) = $this->calculateWeightedProduct($penerima, $kriteria, $bobot);

        // Sort $penerima based on vectorV in descending order
        $penerima = $this->sortPenerimaByVectorV($penerima, $vectorV);

        // Pass data to the view
        $data = [
            'penerima' => $penerima,
            'vectorV' => $vectorV,
        ];

        // Generate PDF
        $pdf = PDF::loadView('perhitungan.cetak', $data);

        // Download the PDF
        return $pdf->download('hasil-perhitungan.pdf');
    }

    private function getPenerimaData($user, $selectedKecamatan, $entries)
    {
        return Penerima::when($user->kecamatan_id !== null, function ($query) use ($user) {
            return $query->where('kecamatan_id', $user->kecamatan_id);
        })
            ->when($user->kecamatan_id === null && $selectedKecamatan, function ($query) use ($selectedKecamatan) {
                return $query->where('kecamatan_id', $selectedKecamatan);
            })
            ->orderBy('id', 'asc')
            ->paginate($entries)
            ->withQueryString();
    }

    private function calculateWeightedProduct($penerima, $kriteria, $bobot)
    {
        // Calculate the sum of all criteria weights
        $sumOfWeights = $bobot->sum('nilai_bk');

        // Calculate normalized weights
        $normalizedWeights = $bobot->map(function ($bb) use ($sumOfWeights) {
            $normalizedWeight = ($sumOfWeights != 0) ? $bb->nilai_bk / $sumOfWeights : 0;

            // Adjust the normalized weight based on the attribute
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

        // Calculate vector V
        $vectorV = $vectorS->map(function ($value, $key) use ($vectorS) {
            $normalizedValue = ($vectorS->sum() != 0) ? $value / $vectorS->sum() : 0;

            return [
                'id' => $key,
                'vector_v' => $normalizedValue,
            ];
        })->pluck('vector_v', 'id');

        return [$normalizedWeights, $vectorS, $vectorV];
    }

    private function sortPenerimaByVectorV($penerima, $vectorV)
    {
        return $penerima->sortByDesc(function ($pnm) use ($vectorV) {
            return $vectorV[$pnm->id];
        });
    }
}
