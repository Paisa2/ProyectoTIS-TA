<?php

namespace App\Observers;

use App\Models\SolicitudItem;
use App\Models\Bitacora;

class SolicitudItemsObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  SolicitudItem  $data
   * @return void
   */
  public function created(SolicitudItem $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Solicitud de resitro de items";
    $bitacora->detalle = "Solicitud de redistro de item registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  User  $user
   * @return void
   */
  public function deleting(SolicitudItem $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Solicitud de registro de items";
    $bitacora->detalle = "Solicitud de redistro de item eliminado";
    $bitacora->save();
  }
}