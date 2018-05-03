<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sombrero extends Model
{
    //
    protected $table = 'sombrero';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idModelo', 'idTejido', 'idPublicoDirigido', 'idMaterial', 'idTalla', 'codigo',
      'precio_venta', 'precio_lista','costo_promedio', 'utilidad', 'stock_actual', 'pedido_reposicion', 
      'costorepminimo', 'costorepmaximo', 'stock_minimo', 'stock_maximo', 'photo'
    ];

    public function ProveedorPrecio()
    {
      # code...
      return $this->belongsto(ProveedorPrecio::class);
    }

    public function FacturaDetalle()
    {
      # code...
      return $this->belongsto(FacturaDetalle::class);
    }

    /*public function GuiaIngresoDetalle()
    {
      # code...
      return $this->belongsto(GuiaIngresoDetalle::class);
    }*/

    public function VentaDetalle()
    {
      # code...
      return $this->belongsto(VentaDetalle::class);
    }

    public function Modelos()
    {
      # code...
      return $this->hasmany(Modelos::class);
    }

    public function Tejidos()
    {
      # code...
      return $this->hasmany(Tejidos::class);
    }

    public function PublicoDirigido()
    {
      # code...
      return $this->hasmany(PublicoDirigido::class);
    }

    public function Materiales()
    {
      # code...
      return $this->hasmany(Materiales::class);
    }

    public function Tallas()
    {
      # code...
      return $this->hasmany(Tallas::class);
    }

    public function Precios()
    {
      # code...
      return $this->belongsto(Precios::class);
    }

    public function Movimiento()
    {
      # code...
      return $this->belongsto(Movimiento::class);
    }
}
