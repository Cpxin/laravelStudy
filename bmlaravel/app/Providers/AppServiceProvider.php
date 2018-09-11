<?php

namespace App\Providers;

use App\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        DB::listen(function ($sql, $bindings, $time){
//            return $sql;
//        });
        DB::listen(function ($query){
//            dd($query->sql);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
