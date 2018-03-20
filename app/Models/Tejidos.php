<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tejidos extends Model
{
    //
    protected $table = 'Tejidos';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'tejido','codigo', 'photo', 'descripcion'
    ];

    public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }
}
