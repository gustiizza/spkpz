<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penerima extends Model
{
    use Searchable, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'alamat',
        'kecamatan_id',
        'kriteria_id',
        'subkriteria_id',
        'nilai',
    ];

    protected $table = 'penerima';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subkriteria(): BelongsTo
    {
        return $this->belongsTo(SubKriteria::class);
    }

    #[SearchUsingPrefix(['nama'])]

    public function searchableAs()
    {
        return 'penerima';
    }

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'kecamatan_id' => $this->kecamatan_id,
            'kriteria_id' => $this->kriteria_id,
            'subkriteria_id' => $this->subkriteria_id,
            'nilai' => $this->nilai,
        ];
    }
}
