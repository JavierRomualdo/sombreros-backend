<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table = 'cargo';
    protected $primarykey = 'id';
    public $timestamps=false;

    protected $fillable = [
      'id', 'cargo', 'descripcion'
    ];

    public function User()
    {
      # code... pertenece a:
      return $this->belongsto(User::class);
    }
}
