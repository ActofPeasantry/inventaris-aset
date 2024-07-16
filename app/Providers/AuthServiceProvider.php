<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('access-admin', fn (User $user) => $user->isAdmin());
        Gate::define('access-kepala-dinas', fn (User $user) => $user->isKepalaDinas());
        Gate::define('access-pegawai', fn (User $user) => $user->isPegawai());

        Gate::define('access-admin-or-kepala-dinas', fn (User $user) => $user->isAdmin() || $user->isKepalaDinas());
    }
}
