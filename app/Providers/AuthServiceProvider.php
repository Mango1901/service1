<?php

namespace App\Providers;

use App\Category;
use App\Customer;
use App\Policies\CategoryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
use App\Policies\StoreImagePolicy;
use App\Policies\WarrantyPolicy;
use App\Product;
use App\Service;
use App\StoreImage;
use App\warrantyDetails;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ServicePolicy',
        Service::class => ServicePolicy::class,
        warrantyDetails::class => WarrantyPolicy::class,
        Product::class=>ProductPolicy::class,
        Category::class=>CategoryPolicy::class,
        StoreImage::class=>StoreImagePolicy::class,
        Customer::class=>CustomerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is-admin',function ($user){
               return $user->roles === 'admin';
        });
        Gate::define('is-root',function ($user){
                return $user->roles === 'root';
        });
    }
}
