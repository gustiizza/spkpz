<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class NilaiPenerima extends Model
{
    use Searchable, HasFactory;

    protected $table = 'nilai_penerima';


    protected $fillable = [
        'penerima_id',
        'kriteria_id',
        'nilai'
    ];


    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'penerima_id');
    }
    public function subkriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'nilai');
    }
}
