<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

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