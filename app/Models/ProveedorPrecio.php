<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProveedorPrecio extends Model
{
    //
    protected $table = 'proveedor_precio';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idProveedor', 'idSombrero', 'precio'
    ];

    public function Proveedor()
    {
      # code...
      return $this->hasmany(Proveedor::class);
    }

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
