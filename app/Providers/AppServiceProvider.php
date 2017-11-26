<?php

namespace App\Providers;

use App\Model\Topic;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //mbsting 767/4 = 191.xxx
        Schema::defaultStringLength(191);


        \View::composer('layout.sidebar',function ($view){

            $topics = Topic::all();

            $view->with('topics',$topics);

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
