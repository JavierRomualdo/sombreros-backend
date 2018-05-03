<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraEmpleado extends Model
{
    //
    protected $table = 'ordencompraempleado';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'idOrdenCompra', 'idEmpleado'
    ];

    public function OrdenCompra()
    {
      # code...
      return $this->hasmany(OrdenCompra::class);
    }

    public function Empleado()
    {
      # code...
      return $this->hasmany(Empleado::class);
    }
}
