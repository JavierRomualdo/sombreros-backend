<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anomalias extends Model
{
    //
    protected $table = 'anomalias';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idGuiaIngreso', 'idFactura', 'resultado'
    ];

    public function GuiaIngreso()
    {
      # code...
      return $this->hasmany(GuiaIngreso::class);
    }

    public function Factura()
    {
      # code...
      return $this->hasmany(Factura::class);
    }
}
