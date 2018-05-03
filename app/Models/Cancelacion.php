<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    //
    protected $table = 'cancelacion';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'reciboprovicional', 'banco', 'numerocuenta', 'fecha'
    ];

    public function CancelacionDetalle()
    {
      # code... pertenece a:
      return $this->belongsto(CancelacionDetalle::class);
    }
}
