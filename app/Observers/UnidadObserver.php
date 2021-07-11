<?php

namespace App\Observers;

use App\Models\Unidad;
use App\Models\Bitacora;

class UnidadObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  Unidad  $data
   * @return void
   */
  public function created(Unidad $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Unidad";
    $bitacora->detalle_bitacora = "Unidad " . $data->nombre_unidad . " registrado.";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  Unidad  $data
   * @return void
   */
  public function deleting(Unidad $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Unidad";
    $bitacora->detalle_bitacora = "Unidad " . $data->nombre_unidad . " eliminado.";
    $bitacora->save();
  }

  /**
   * Listen to the User updated event.
   *
   * @param  Unidad  $data
   * @return void
   */
  public function updating(Unidad $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Editar";
    $bitacora->modulo = "Unidad";
    $bitacora->detalle_bitacora = "Unidad " . $data->nombre_unidad . " fue editada.";
    $bitacora->save();
  }

}