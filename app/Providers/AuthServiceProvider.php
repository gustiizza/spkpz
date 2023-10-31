<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Kriteria;
use App\Models\Penerima;
use App\Models\SubKriteria;
use App\Models\User;
use App\Policies\KriteriaPolicy;
use App\Policies\PenerimaPolicy;
use App\Policies\PenggunaPolicy;
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
        Penerima::class => PenerimaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
