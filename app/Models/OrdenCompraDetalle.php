<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    //
    protected $table = 'orden_compra_detalle';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idOrdenCompra', 'idSombrero', 'cantidad', 'precio_unitario', 'descripcion'
    ];

    public function OrdenCompra()
    {
      # code...
      return $this->hasmany(OrdenCompra::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
