<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    //
    protected $table = 'Precios';
    protected $primarykey = 'id';

    protected $fillable = [
      'id', 'idSombrero','stock','costo', 'precio'
    ];

    public function Sombrero()
    {
      # code...
      return $this->hasmany(Sombrero::class);
    }
}
