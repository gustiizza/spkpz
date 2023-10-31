<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use App\Models\Kriteria;
use App\Models\Penerima;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NilaiPenerima extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'penerima_id',
        'kriteria_id',
        'subkriteria_id',
        'nilai',
    ];

    protected $table = 'nilai_penerima';

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subkriteria(): BelongsTo
    {
        return $this->belongsTo(SubKriteria::class);
    }

    public function penerima(): HasOne
    {
        return $this->hasOne(Penerima::class);
    }

    #[SearchUsingPrefix(['nama'])]

    public function toSearchableArray()
    {
        return [
            'penerima_id' => $this->peneria_id,
            'kriteria_id' => $this->kriteria_id,
            'subkriteria_id' => $this->subkriteria_id,
            'nilai' => $this->nilai,
        ];
    }
}
