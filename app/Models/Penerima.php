<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SubKriteria;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penerima extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'nama',
        'alamat',
        'kecamatan'
    ];

    protected $table = 'penerima';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function nilai_penerima(): HasOne
    {
        return $this->hasOne(NilaiPenerima::class);
    }

    #[SearchUsingPrefix(['nama'])]

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'alamat' => $this->alamat,
        ];
    }
}
