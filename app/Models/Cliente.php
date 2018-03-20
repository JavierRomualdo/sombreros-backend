<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = 'Cliente';
    protected $primarykey = 'id';
    //public $timestamps=false;

    protected $fillable = [
      'id', 'nombres', 'apellidos' ,'dni', 'direccion', 'telefono'
    ];

    public function Venta()
    {
      # code...
      return $this->belongsto(Venta::class);
    }
}
