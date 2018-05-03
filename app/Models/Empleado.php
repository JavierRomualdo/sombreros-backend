<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table = 'Empleado';
    protected $primarykey = 'id';
    //public $timestamps=false;

    protected $fillable = [
      'id', 'idEncargo', 'nombres', 'apellidos' ,'dni', 'direccion', 'telefono', 'email'
    ];

    public function Venta()
    {
      # code...
      return $this->belongsto(Venta::class);
    }

    public function ComisionEmpleado()
    {
      # code...
      return $this->belongsto(ComisionEmpleado::class);
    }

    public function OrdenCompraEmpleado()
    {
      # code... pertenece a:
      return $this->belongsto(OrdenCompraEmpleado::class);
    }

    public function Encargo()
    {
      # code...
      return $this->hasmany(Encargo::class);
    }

}
