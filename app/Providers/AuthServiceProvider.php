<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Model\Category;
use App\Model\Product;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Model\Category' => 'App\Policies\CategoryPolicy',
        'App\Model\Product' => 'App\Policies\ProductPolicy',
        'App\Model\Brand' => 'App\Policies\BrandPolicy',
        'App\Model\Vendor' => 'App\Policies\VendorPolicy',
        'App\Model\Banner' => 'App\Policies\BannerPolicy',
        'App\Model\Article' => 'App\Policies\ArticlePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Role' => 'App\Policies\RolePolicy',
        'App\Model\Coupon' => 'App\Policies\CouponPolicy',
        'App\Model\Order' => 'App\Policies\OrderPolicy',
        'App\Model\Contact' => 'App\Policies\ContactPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('setting-website', 'App\Policies\SettingPolicy@setting');
    }

  /*  public function registerPoliciesProduct(){
        Gate::define('view-products', 'App\Policies\ProductPolicy@view');
        Gate::define('create-products', 'App\Policies\ProductPolicy@create');
        Gate::define('edit-products', 'App\Policies\ProductPolicy@update');
        Gate::define('delete-products', 'App\Policies\ProductPolicy@delete');
    }*/

   /* public function registerPoliciesCategory(){
        Gate::define('view-categories' , 'App\Policies\CategoryPolicy@view');
    }*/
}
