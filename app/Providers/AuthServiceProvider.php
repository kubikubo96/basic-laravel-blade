<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
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
//         'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //SupperAdmin
        Gate::before(function ($user) {
            if ($user->id === User::SUPPER_ADMIN_ID) {
                return true;
            }
        });

        if (!$this->app->runningInConsole()) {
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
    }
}
