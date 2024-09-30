<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
    // public function boot(): void
    // {
    //     // Tentukan data pengguna secara langsung
    //     $userSales = DB::table('user_sales')->where('username', 'citradewi')->first();
    //     $userAgen = DB::table('user_agen')->where('username', 'hendrawijaya')->first();

    //     // Memberikan data pengguna ke view
    //     View::composer('*', function ($view) use ($userSales, $userAgen) {
    //         $view->with('userSales', $userSales);
    //         $view->with('userAgen', $userAgen);
    //     });
    // }
}
