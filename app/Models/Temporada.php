<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    //
    protected $table = 'Temporada';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'temporada','photo', 'fecha_inicio', 'fecha_fin', 'descripcion'
    ];

    public function ComisionEmpleado()
    {
      # code...
      return $this->belongsto(ComisionEmpleado::class);
    }
}
