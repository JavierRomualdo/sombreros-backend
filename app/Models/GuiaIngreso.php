<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaIngreso extends Model
{
    //
    protected $table = 'guia_ingreso';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'numero_guia', 'numero_documento', 'fecha'
    ];

    public function GuiaIngresoDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(GuiaIngresoDetalle::class);
    }

    public function Anomalias()
    {
      # code... pertenece a:
      return $this->belongsto(Anomalias::class);
    }
}
