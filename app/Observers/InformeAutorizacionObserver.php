<?php

namespace App\Observers;

use App\Models\InformeAutorizacion;
use App\Models\Bitacora;

class InformeAutorizacionObserver
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
    $bitacora->modulo = "Informe autorizacion";
    $bitacora->detalle = "Informe autorizacion de la solicitud de adquisicion N° " . " registrado";
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
    $bitacora->modulo = "Informe autorizacion";
    $bitacora->detalle = "Informe autorizacion de la solicitud de adquisicion N° " . " eliminado";
    $bitacora->save();
  }
}