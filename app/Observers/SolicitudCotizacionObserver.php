<?php

namespace App\Observers;

use App\Models\Solicitud_cotizacion;
use App\Models\Bitacora;

class SolicitudCotizacionObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  Solicitud_cotizacion  $data
   * @return void
   */
  public function created(Solicitud_cotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Solicitud de cotizacion";
    $bitacora->detalle = "Solicitud de cotizacion N° " . $data->codigo_cotizacion . " registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  User  $user
   * @return void
   */
  public function deleting(Solicitud_cotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Solicitud de cotizacion";
    $bitacora->detalle = "Solicitud de cotizacion N° " . $data->codigo_cotizacion . " eliminado";
    $bitacora->save();
  }
}