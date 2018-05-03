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
      'id', 'idOrdenCompra', 'idProveedorPrecio', 'idPedidoReposicionDetalle', 'cantidad', 'cantidadingreso', 
      'estadoingreso', 'costounitario', 'descripcion'
    ];

    public function OrdenCompra()
    {
      # code...
      return $this->hasmany(OrdenCompra::class);
    }

    public function ProveedorPrecio()
    {
      # code...
      return $this->hasmany(ProveedorPrecio::class);
    }

    public function PedidoReposicionDetalle()
    {
      # code...
      return $this->hasmany(PedidoReposicionDetalle::class);
    }

    public function GuiaIngresoDetalle()
    {
      # code...
      return $this->belongsto(GuiaIngresoDetalle::class);
    }
}
