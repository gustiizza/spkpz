<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

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

    /*
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /*protected $hidden = [
        '',
    ]; */

    /*
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /*protected $casts = [
        'password' => 'hashed',
    ]; */

    #[SearchUsingPrefix(['status'])]

    public function toSearchableArray()
    {
        return [
            'kode_kriteria' => $this->kode_kriteria,
            'nama' => $this->nama,
            'atribut' => $this->atribut,
        ];
    }
}
