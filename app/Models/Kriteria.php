<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use App\Models\SubKriteria;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory, Notifiable, Searchable;
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
