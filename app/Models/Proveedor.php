<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //
    protected $table = 'proveedor';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'titular', 'dni_titular', 'telefono_titular', 'email_titular',
      'segundo_contacto', 'dni_segundo', 'telefono_segundo', 'email_segundo',
      'empresa', 'ruc', 'direccion','numero_cuenta', 'fecha_ingreso'
    ];

    public function ProveedorPrecio()
    {
      # code... pertenece a:
      return $this->belongsto(ProveedorPrecio::class);
    }
}
