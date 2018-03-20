<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atributos extends Model
{
    //
    protected $table = 'Atributos';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'igv','margenganancia', 'gastosservicios'
    ];

    /*public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }*/
}
