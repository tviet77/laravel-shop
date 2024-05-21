<?php

namespace App\Providers;


use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->defineGateCategory();

        //Show menu frontend
        View::composer('client.*', function ($view) {
            $categoryMenu = Category::all();
            $view->with('categoryMenu', $categoryMenu);
        });

        //add pagination boostrap: Phân trang của laravel
        Paginator::useBootstrap();
    }

     public function defineGateCategory()
     {
         Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
         Gate::define('category-create', 'App\Policies\CategoryPolicy@create');
         Gate::define('category-update', 'App\Policies\CategoryPolicy@update');
         Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
     }
}
