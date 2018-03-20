<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'venta';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'idEmpleado', 'idCliente', 'numero_venta', 'fecha', 'utilidad', 'idUsuario'
    ];

    public function User()
    {
      # code...
      return $this->hasmany(User::class);
    }

    public function Cliente()
    {
      # code...
      return $this->hasmany(Cliente::class);
    }

    public function Empleado()
    {
      # code...
      return $this->hasmany(Empleado::class);
    }

    public function VentaDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(VentaDetalle::class);
    }
}
