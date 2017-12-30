<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    //
    protected $table = 'Modelos';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'modelo', 'photo', 'descripcion'
    ];

    public function Sombrero()
    {
      # code...
      return $this->belongsto(Sombrero::class);
    }
}
