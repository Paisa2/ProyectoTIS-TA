<?php

namespace App\Observers;

use App\Models\RespuestaCotizacion;
use App\Models\Bitacora;

class RespuestaCotizacionObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  RespuestaCotizacion  $data
   * @return void
   */
  public function created(RespuestaCotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Propuesta de cotizacion";
    $bitacora->detalle_bitacora = "Propuesta de cotizacion de la empresa " . $data->razon_social . " registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  RespuestaCotizacion  $data
   * @return void
   */
  public function deleting(RespuestaCotizacion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Propuesta de cotizacion";
    $bitacora->detalle_bitacora = "Propuesta de cotizacion de la empresa " . $data->razon_social . " eliminado";
    $bitacora->save();
  }
}