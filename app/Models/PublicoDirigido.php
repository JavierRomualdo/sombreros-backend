<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicoDirigido extends Model
{
    //
    protected $table = 'publicodirigido';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'publico','codigo', 'descripcion'
    ];

    public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }
}
