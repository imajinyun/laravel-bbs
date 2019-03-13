<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \Carbon\Carbon::setLocale('zh');
    }
}
