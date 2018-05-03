<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    protected $table = 'movimiento';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'idSombrero','cantidadingreso','costounitario','costototal','cantidadsalida','preciounitario',
      'preciototal','stock_actual','valor','costopromedio','margenganancia','preciosistema','fecha'
    ];

    public function Sombrero()
    {
      # code... pertenece a:
      return $this->hasmany(Sombrero::class);
    }
}
