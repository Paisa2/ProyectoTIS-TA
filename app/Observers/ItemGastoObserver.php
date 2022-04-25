<?php

namespace App\Observers;

use App\Models\ItemGasto;
use App\Models\Bitacora;

class ItemGastoObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  ItemGasto  $data
   * @return void
   */
  public function created(ItemGasto $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Item de gasto";
    $bitacora->detalle_bitacora = "Item de gasto " . $data->nombre_item . " registrado.";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  ItemGasto  $data
   * @return void
   */
  public function deleting(ItemGasto $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Item de gasto";
    $bitacora->detalle_bitacora = "Item de gasto " . $data->nombre_item . " eliminado.";
    $bitacora->save();
  }
}