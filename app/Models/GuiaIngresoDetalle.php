<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaIngresoDetalle extends Model
{
    //
    protected $table = 'guia_ingreso_detalle';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idGuiaIngreso', 'idSombrero', 'cantidad', 'descripcion'
    ];

    public function GuiaIngreso()
    {
      # code...
      return $this->hasmany(GuiaIngreso::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
