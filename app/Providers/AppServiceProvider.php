<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Auth::guest()) {
            view()->composer('*', function ($view)
            {
                $notificaciones = Notificacion::where("unidad_id", session("unidad_id"))->orderBy("created_at", "desc")->limit(5)->get();
                $view->with('notificaciones', $notificaciones);
            });
        }
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
