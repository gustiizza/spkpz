<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Hasil;
use App\Models\Kriteria;
use App\Models\Penerima;
use App\Models\Perhitungan;
use App\Models\SubKriteria;
use App\Models\LihatPenerima;
use App\Models\User;
use App\Models\Bobot;
use App\Policies\BobotPolicy;
use App\Policies\HasilPolicy;
use App\Policies\KriteriaPolicy;
use App\Policies\LihatPenerimaPolicy;
use App\Policies\PenerimaPolicy;
use App\Policies\PenggunaPolicy;
use App\Policies\PerhitunganPolicy;
use App\Policies\SubKriteriaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => PenggunaPolicy::class,
        Kriteria::class => KriteriaPolicy::class,
        SubKriteria::class => SubKriteriaPolicy::class,
        Bobot::class => BobotPolicy::class,
        Penerima::class => PenerimaPolicy::class,
        LihatPenerima::class => LihatPenerimaPolicy::class,
        Perhitungan::class => PerhitunganPolicy::class,
        Hasil::class => HasilPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
