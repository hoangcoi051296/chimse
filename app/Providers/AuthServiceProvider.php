<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use App\Models\Employee;
use App\Policies\EmployeePolicy;
use App\Models\Customer;
use App\Policies\CustomerPolicy;
use App\Models\Category;
use App\Models\Attribute;
use App\Policies\CategoryPolicy;
use App\Policies\AttributePolicy;
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
        Post::class => PostPolicy::class,
        Employee::class=>EmployeePolicy::class,
        Customer::class=>CustomerPolicy::class,
        Category::class=>CategoryPolicy::class,
        Attribute::class=>AttributePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('post_manager', 'App\Policies\PostPolicy@viewAny');
        Gate::define('employee_manager', 'App\Policies\EmployeePolicy@viewAny');
        Gate::define('customer_manager', 'App\Policies\CustomerPolicy@viewAny');
        Gate::define('category_manager', 'App\Policies\CategoryPolicy@viewAny');
        Gate::define('attribute_manager', 'App\Policies\AttributePolicy@viewAny');
    }

}
