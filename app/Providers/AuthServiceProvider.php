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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->changeStatusManager();
        $this->editPostManager();
        Gate::define('edit-post', 'App\CustomPolicy@editPost');
    }

    public function changeStatusManager()
    {
        Gate::define('managerChangeStatus', function ($user, $post) {
            return $post->status==1 ||$post->status==2;
        });
    }
    public function editPostManager()
    {
        Gate::define('editPost',function ($user,$post){
            return true;
        });

    }
    public function cancelPostManager()
    {
        Gate::define('cancelPost', function ($user, $post) {
            return $post->status==1 ||$post->status==2 ||$post->status==3 ||$post->status==4;
        });
    }
}
