<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Event::saving(function (Event $event) {
            $event->beforeSave();
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
