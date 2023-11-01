<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use App\Models\SubKriteria;
use App\Models\Penerima;
use App\Models\Bobot;

class Kriteria extends Model
{
    use HasFactory, Notifiable, Searchable, SoftDeletes;
    /* *
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_kriteria',
        'nama',
        'atribut',
    ];

    protected $table = 'kriteria';

    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penerima(): HasMany
    {
        return $this->hasMany(Penerima::class);
    }
    public function bobot(): HasMany
    {
        return $this->HasMany(Bobot::class);
    }

    #[SearchUsingPrefix(['nama'])]

    public function toSearchableArray()
    {
        return [
            'kode_kriteria' => $this->kode_kriteria,
            'nama' => $this->nama,
            'atribut' => $this->atribut,
        ];
    }
}
