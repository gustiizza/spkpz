<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Kecamatan extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'nama',
    ];

    protected $table = 'kecamatan';

    public function User(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function penerima(): HasMany
    {
        return $this->hasMany(Penerima::class);
    }

    #[SearchUsingPrefix(['nama'])]

    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
        ];
    }
}
