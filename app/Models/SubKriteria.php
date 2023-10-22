<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Attributes\SearchUsingPrefix;


class SubKriteria extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'nama',
        'kriteria_id',
        'nama_sub_kriteria',
        'nilai_sk',
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    protected $table = 'sub_kriteria';

    #[SearchUsingPrefix(['status'])]

    public function toSearchableArray()
    {
        return [
            'kriteria_id' => $this->kode_kriteria,
            'nama_sub_kriteria' => $this->nama_sub_kriteria,
            'nilai_sk' => $this->nilai_sk,
        ];
    }
}