<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idCargo','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Factura()
    {
      # code... pertenece a:
      return $this->belongsto(Factura::class);
    }

    public function Venta()
    {
      # code... pertenece a:
      return $this->belongsto(Venta::class);
    }

    public function Cargo()
    {
      # code... pertenece a:
      return $this->hasmany(Cargo::class);
    }
}
