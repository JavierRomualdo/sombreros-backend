<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargo extends Model
{
    //
    protected $table = 'Encargo';
    protected $primarykey = 'id';
    //public $timestamps=false;

    protected $fillable = [
      'id', 'nombre', 'descripcion'
    ];

    public function Empleado()
    {
      # code...
      return $this->belongsto(Empleado::class);
    }
}
