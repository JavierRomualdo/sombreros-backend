<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelacionDetalle extends Model
{
    //
    protected $table = 'cancelaciondetalle';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idCancelacion', 'idVenta'
    ];

    public function Cancelacion()
    {
      # code...
      return $this->hasmany(Cancelacion::class);
    }

    public function Venta()
    {
      # code...
      return $this->hasmany(Venta::class);
    }
}
