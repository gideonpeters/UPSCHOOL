<?php

namespace App\Providers;

use App\Event;
use App\Gradelist;
use App\Observers\EventObserver;
use App\Observers\GradelistObserver;
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
        //
        Event::observe(EventObserver::class);
        Gradelist::observe(GradelistObserver::class);
    }
}
