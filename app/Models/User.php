<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;


    public function getRedirectRoute()
    {
        switch ($this->status) {
            case 'op':
                return '/pengguna';
            case 'dm':
                return '/bobot';
            case 'rz':
                return '/penerima';
        }
    }

    /* *
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'status',
        'kecamatan_id'
    ];

    /*
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /*
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function penerima(): HasMany
    {
        return $this->hasMany(Penerima::class, 'kecamatan_id');
    }

    #[SearchUsingPrefix(['status'])]
    
    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
            'email' => $this->email,
            'status' => $this->status,
        ];
    }
}