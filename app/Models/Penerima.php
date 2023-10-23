<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penerima extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'nama',
        'alamat',
    ];

    protected $table = 'penerima';

    public function kriteria(): HasMany
    {
        return $this->hasMany(Kriteria::class);
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
