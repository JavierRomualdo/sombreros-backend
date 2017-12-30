<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table = 'factura';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'numero_factura', 'fecha', 'comprador', 'idUsuario'
    ];

    public function User()
    {
      # code...
      return $this->hasmany(User::class);
    }

    public function Anomalias()
    {
      # code... pertenece a:
      return $this->belongsto(Anomalias::class);
    }

    public function FacturaDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(FacturaDetalle::class);
    }
}
