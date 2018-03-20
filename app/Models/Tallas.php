<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tallas extends Model
{
    //
    protected $table = 'Tallas';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'talla','codigo', 'descripcion'
    ];

    public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }
}
