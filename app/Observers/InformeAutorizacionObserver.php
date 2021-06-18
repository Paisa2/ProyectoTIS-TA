<?php

namespace App\Observers;

use App\Models\InformeAutorizacion;
use App\Models\InformeComparativo;
use App\Models\Bitacora;

class InformeAutorizacionObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  InformeAutorizacion  $data
   * @return void
   */
  public function created(InformeAutorizacion $data)
  {
    $codigo = InfoComparativo::where("id", $data->cotizacion_id)->first()->codigo_solicitud_a;
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Informe de autorizacion";
    $bitacora->detalle = "Informe de autorizacion de la solicitud de adquisicion N° " . $codigo . " registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  InformeAutorizacion  $data
   * @return void
   */
  public function deleting(InformeAutorizacion $data)
  {
    $codigo = InfoComparativo::where("id", $data->cotizacion_id)->first()->codigo_solicitud_a;
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Informe de autorizacion";
    $bitacora->detalle = "Informe de autorizacion de la solicitud de adquisicion N° " . $codigo . " eliminado";
    $bitacora->save();
  }
}