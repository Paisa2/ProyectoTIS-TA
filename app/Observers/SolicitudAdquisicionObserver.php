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
  public function updating(Solicitud_adquisicion $data)
  {
    $estado = $data->estado_solicitud_a;
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->modulo = "Solicitud de adquisicion";
    if($estado == "Pendiente"){
      if ($data->getOriginal('estado_solicitud_a') == "Registrado") {
        $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue enviada.";
        $operacion = "Enviar";
      } else if ($data->getOriginal('estado_solicitud_a') == "Plazo de espera vencido") {
        $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue reenviada.";
        $operacion = "Reenviar";
      }
    } else if ($estado == "Proceso de cotizacion"){
      $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue aceptada para la cotización.";
      $operacion = "Verificar";
    } else if($estado == "Rechazado por falta de presupuesto"){
      $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue rechazada por falta de presupuesto.";
      $operacion = "Verificar";
    } else if($estado == "Aceptado") {
      $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue aceptada para su adquisicion.";
      $operacion = "Verificar";
    } else if($estado == "Rechazado") {
      $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue rechazada.";
      $operacion = "Verificar";
    } else if ($estado == $data->getOriginal('estado_solicitud_a')) {
      $mensaje = "Solicitud adquisicion N° " . $data->codigo_solicitud_a . " fue editada.";
      $operacion = "Editar";
    }else  {
      $mensaje = "Estado inconsistente.";
      $operacion = "Error";
    }
    $bitacora->detalle_bitacora = $mensaje;
    $bitacora->operacion = $operacion;
    $bitacora->save();
  }
}