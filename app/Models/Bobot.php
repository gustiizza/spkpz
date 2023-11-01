<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;


class Bobot extends Model
{
    use HasFactory, Notifiable, Searchable;

    protected $fillable = [
        'kriteria_id',
        'nilai_bk',
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    protected $table = 'bobot';

    #[SearchUsingPrefix(['status'])]

    public function toSearchableArray()
    {
        return [
            'kriteria_id' => $this->kriteria_id,
            'nilai_bk' => $this->nilai_bk,
        ];
    }
}
