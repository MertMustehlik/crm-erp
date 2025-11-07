<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Customer;
use App\Policies\CustomerPolicy;

class PolicyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Customer::class, CustomerPolicy::class);
    }
}
