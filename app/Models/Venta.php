<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'venta';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'numero_venta', 'fecha', 'utilidad', 'idUsuario'
    ];

    public function User()
    {
      # code...
      return $this->hasmany(User::class);
    }

    public function VentaDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(VentaDetalle::class);
    }
}
