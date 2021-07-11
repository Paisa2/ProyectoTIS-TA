<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

use App\Models\Solicitud_adquisicion;
use App\Observers\SolicitudAdquisicionObserver;
use App\Models\SolicitudItem;
use App\Observers\SolicitudItemObserver;
use App\Models\Solicitud_cotizacion;
use App\Observers\SolicitudCotizacionObserver;
use App\Models\RespuestaCotizacion;
use App\Observers\RespuestaCotizacionObserver;
use App\Models\ComparativoCotizacion;
use App\Observers\ComparativoCotizacionObserver;
use App\Models\InformeAutorizacion;
use App\Observers\InformeAutorizacionObserver;
use App\Models\Empresa;
use App\Observers\EmpresaObserver;
use App\Models\Unidad;
use App\Observers\UnidadObserver;
use App\Models\ItemGasto;
use App\Observers\ItemGastoObserver;

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
        
        Solicitud_adquisicion::observe(SolicitudAdquisicionObserver::class);
        Solicitud_cotizacion::observe(SolicitudCotizacionObserver::class);
        SolicitudItem::observe(SolicitudItemObserver::class);
        RespuestaCotizacion::observe(RespuestaCotizacionObserver::class);
        ComparativoCotizacion::observe(ComparativoCotizacionObserver::class);
        InformeAutorizacion::observe(InformeAutorizacionObserver::class);
        Empresa::observe(EmpresaObserver::class);
        Unidad::observe(UnidadObserver::class);
        ItemGasto::observe(ItemGastoObserver::class);
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
