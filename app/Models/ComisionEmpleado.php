<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComisionEmpleado extends Model
{
    //
    protected $table = 'comisionempleado';
    protected $primarykey = 'id';
    //public $timestamps=false;

    protected $fillable = [
      'id', 'idEmpleado', 'idSombrero', 'porcentaje', 'descripcion'
    ];

    public function Empleado()
    {
      # code...
      return $this->hasmany(Empleado::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
