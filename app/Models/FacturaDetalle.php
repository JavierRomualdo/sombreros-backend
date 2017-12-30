<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    //
    protected $table = 'factura_detalle';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idFactura', 'idSombrero', 'descripcion', 'precio_unitario', 'cantidad', 'sub_total'
    ];

    public function Factura()
    {
      # code...
      return $this->hasmany(Factura::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
