<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    //
    protected $table = 'venta_detalle';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'idVenta', 'idSombrero', 'cantidad', 'costo_promedio','precio_venta','costo', 'porcentaje_descuento', 
      'descuento', 'sub_total', 'costo_total', 'utilidad', 'descripcion'
    ];

    public function Venta()
    {
      # code...
      return $this->hasmany(Venta::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
