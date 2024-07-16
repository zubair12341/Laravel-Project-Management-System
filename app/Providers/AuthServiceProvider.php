<?php

namespace App\Providers;

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

        // Only Admin can access is gate
        // Gate::define(['all-project','add-project'], function($user){
        //     return $user->hasRole(['Admin']);
        // });

        // Only Admin & Manager can access is gate
        // Gate::define(['project', 'all-project', 'add-project', 'edit-project', 'delete-project'], function($user){
        //     return $user->hasAnyRole(['Admin', 'Manager']);
        // });
        Gate::define('admin', function($user){
            return $user->hasRole('Admin');
        });
        Gate::define('domain', function($user){
            return $user->hasRole('Admin');
        });
        Gate::define('admin-dashboard', function($user){
            return $user->hasRole('Admin');
        });

        Gate::define('employee-dashboard', function($user){
            return $user->hasRole('Employee');
        });

        Gate::define('manager-dashboard', function($user){
            return $user->hasRole('Manager');
        });

        Gate::define('hr-dashboard', function($user){
            return $user->hasRole('HR');
        });

        Gate::define('client', function($user){
            return $user->hasAnyRole(['Admin', 'Manager','HR']);
        });

        Gate::define('project', function($user){
            return $user->hasAnyRole(['Admin','HR']);
        });

        Gate::define('tasktracker', function($user){
            return $user->hasAnyRole(['Admin', 'Manager']);
        });

        Gate::define('employee', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('timetracker', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('leave-list', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('payslip', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('department', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('users', function($user){
            return $user->hasAnyRole(['Admin']);
        });

        Gate::define('task', function($user){
            return $user->hasAnyRole(['Manager', 'Employee']);
        });

        Gate::define('leave', function($user){
            return $user->hasAnyRole(['Manager', 'Employee']);
        });



    }
}
