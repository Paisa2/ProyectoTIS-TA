<?php

namespace App\Observers;

use App\Models\Empresa;
use App\Models\Bitacora;

class EmpresaObserver
{
  /**
   * Listen to the User created event.
   *
   * @param  Empresa  $data
   * @return void
   */
  public function created(Empresa $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Registrar";
    $bitacora->modulo = "Empresa";
    $bitacora->detalle_bitacora = "Empresa " . $data->nombre_empresa . " registrado.";
    $bitacora->save();
  }

  /**
   * Listen to the User deleting event.
   *
   * @param  Empresa  $data
   * @return void
   */
  public function deleting(Empresa $data)
  {
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Eliminar";
    $bitacora->modulo = "Empresa";
    $bitacora->detalle_bitacora = "Empresa " . $data->nombre_empresa . " eliminado.";
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
    $bitacora = new Bitacora;
    $bitacora->usuario_id = session("id");
    $bitacora->operacion = "Editar";
    $bitacora->modulo = "Empresa";
    $bitacora->detalle_bitacora = "Empresa " . $data->nombre_empresa . " fue editada.";
    $bitacora->save();
  }

}