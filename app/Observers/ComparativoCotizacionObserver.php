<?php

namespace App\Observers;

use App\Models\ComparativoCotizacion;
use App\Models\Solicitud_cotizacion;
use App\Models\Bitacora;

class ComparativoCotizacionObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  ComparativoCotizacion  $data
   * @return void
   */
  public function created(ComparativoCotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Cuadro comparativo de cotizaciones";
    $bitacora->detalle = "Cuadro comparativo de cotizaciones N° " . Solicitud_cotizacion::where("id", $data->cotizacion_id)->first()->codigo_cotizacion . " registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  ComparativoCotizacion  $data
   * @return void
   */
  public function deleting(ComparativoCotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Cuadro comparativo de cotizaciones";
    $bitacora->detalle = "Cuadro comparativo de cotizaciones N° " . Solicitud_cotizacion::where("id", $data->cotizacion_id)->first()->codigo_cotizacion . " eliminado";
    $bitacora->save();
  }
}