<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadosProveedor extends Model
{
    //
    protected $table = 'proveedor_estados';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'estado_titular', 'estado_dni_titular', 'estado_telefono_titular', 'estado_email_titular',
       'estado_segundo_contacto', 'estado_dni_segundo','estado_telefono_segundo', 'estado_email_segundo',
      'estado_empresa', 'estado_ruc', 'estado_direccion', 'estado_numero_cuenta'
    ];
}
