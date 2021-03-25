<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-appointments', function ($user) {
            if (Auth::check()) {
                if (Auth::user()->is_user || Auth::user()->is_admin) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        Gate::define('edit-appointments', function ($user, $appointment) {
            if (Auth::check()) {
                if (Auth::user()->is_admin|| (Auth::user()->is_user && $user->id === $appointment->user_id)
                    || (Auth::user()->is_employee && $user->id === $appointment->employee_id)){
                    return true;
                } else {
                    return false;
                }
            }
        });


    }
}
