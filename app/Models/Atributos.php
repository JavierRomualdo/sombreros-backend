<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atributos extends Model
{
    //
    protected $table = 'Atributos';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'igv','margenganancia', 'preciominimo', 'preciomaximo', 'costorepmaximo', 'costoserviciorep', 
      'descuentoventa', 'descuentoextra', 'comision','rangopr1','mensajepr1','colorpr1','rangopr2','mensajepr2',
      'colorpr2','rangopr3','mensajepr3','colorpr3'
    ];

    /*public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }*/
}
