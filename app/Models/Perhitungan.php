<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Perhitungan extends Model
{
    use Searchable, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'alamat',
        'kecamatan_id',
        'nilai'
    ];

    protected $casts = [
        'nilai' => 'array',
    ];

    protected $table = 'penerima';

    // Penerima.php
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kriteria(): BelongsToMany
    {
        return $this->belongsToMany(Kriteria::class);
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
            'nilai' => $this->nilai,
        ];
    }
}
