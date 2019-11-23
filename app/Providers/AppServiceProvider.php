<?php

namespace App\Providers;

use API;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (app()->isLocal()) {
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }

        API::error(static function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            abort(404);
        });

        API::error(static function (\Illuminate\Auth\Access\AuthorizationException $exception) {
            abort(403);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        \Carbon\Carbon::setLocale('zh');

        view()->composer('admin.layouts.app', static function (\Illuminate\View\View $view) {
            $navbars = config('menu.admin.children');
            $view->with('navbars', $navbars);
        });
    }
}
