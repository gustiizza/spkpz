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

class NilaiPenerima extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'nama',
        'alamat',
    ];

    protected $table = 'nilai_penerima';

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function penerima(): BelongsTo
    {
        return $this->belongsTo(Penerima::class, 'penerima_id');
    }

    #[SearchUsingPrefix(['nama'])]

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'atribut' => $this->atribut,
        ];
    }
}
