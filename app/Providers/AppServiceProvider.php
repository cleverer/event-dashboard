<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('editToken', function () {
	        return '<?php if (request()->has(\'token\')) { echo \'<input type="hidden" name="token" value="\'.request(\'token\').\'">\'; } ?>';
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
