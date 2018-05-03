<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoReposicion extends Model
{
    //
    protected $table = 'pedidoreposicion';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idProveedorPrecio', 'cantidad', 'cantidadingresado', 
      'cantidadorden', 'estado', 'fecha'
    ];

    public function ProveedorPrecio()
    {
      # code...
      return $this->hasmany(ProveedorPrecio::class);
    }

    public function OrdenCompraDetalle()
    {
      # code...
      return $this->belongsto(OrdenCompraDetalle::class);
    }
}
