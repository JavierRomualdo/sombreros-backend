<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    //
    protected $table = 'orden_compra';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'numero_orden', 'fecha'
    ];

    public function OrdenCompraDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(OrdenCompraDetalle::class);
    }
}
