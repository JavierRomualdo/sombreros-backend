<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiales extends Model
{
    //
    protected $table = 'Materiales';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'material','codigo', 'photo', 'descripcion'
    ];

    public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }
}
