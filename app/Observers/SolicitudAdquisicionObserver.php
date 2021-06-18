<?php

namespace App\Observers;

use App\Models\Solicitud_adquisicion;
use App\Models\Bitacora;

class SolicitudAdquisicionObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  Solicitud_adquisicion  $data
   * @return void
   */
  public function created(Solicitud_adquisicion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Solicitud de adquisicion";
    $bitacora->detalle_bitacora = "Solicitud de adquisicion N° " . $data->codigo_solicitud_a . " registrado";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  Solicitud_adquisicion  $data
   * @return void
   */
  public function deleting(Solicitud_adquisicion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Solicitud de adquisicion";
    $bitacora->detalle_bitacora = "Solicitud de adquisicion N° " . $data->codigo_solicitud_a . " eliminado";
    $bitacora->save();
  }

  /**
   * Listen to the User updated event.
   *
   * @param  Solicitud_adquisicion  $data
   * @return void
   */
  public function updated(Solicitud_adquisicion $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->modulo = "Solicitud de adquisicion";
    if ($data->estado_solicitud_a == "Proceso de cotizacion"){
      $bitacora->detalle = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue aceptada para la cotización";
      $bitacora->operacion = "Verificar";
    }else if($data->estado_solicitud_a == "Rechazado por falta de presupuesto"){
      $bitacora->detalle = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue rechazada por falta de presupuesto";
      $bitacora->operacion = "Verificar";
    }else if($data->estado_solicitud_a == "Pendiente"){
      $bitacora->detalle = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue enviada";
      $bitacora->operacion = "Enviar";
    }else {
      $bitacora->detalle = "algo anda mal con los estados";
      $bitacora->operacion = "Error";
    }
    $bitacora->save();
  }
}