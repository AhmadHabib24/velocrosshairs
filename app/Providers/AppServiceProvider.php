<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

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
        //
        View::composer('*', function ($view) {
            $categories = Category::where('is_active', true)->orderBy('name')->get();
            $view->with('navCategories', $categories);
        });

        View::composer(['auth.login', 'auth.register'], function ($view) {
            $num1 = random_int(1, 10);
            $num2 = random_int(1, 10);
            session(['captcha_answer' => $num1 + $num2]);
            $view->with(compact('num1', 'num2'));
        });

        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.custom');
    }
}
