<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EstadosProveedor;
use App\Models\Cargo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Ingreso: primer registro en tabla proveedor_estados*/
        if (EstadosProveedor::count()==0) {//Al inicio no hay registro, entonces por defecto se registra
            # code...
            $estados = EstadosProveedor::insert(['estado_titular'=>'N', 'estado_dni_titular'=>'N', 
            'estado_telefono_titular'=>'N', 'estado_email_titular'=>'N', 'estado_segundo_contacto'=>'N',
            'estado_dni_segundo'=>'N', 'estado_telefono_segundo'=>'N', 'estado_email_segundo'=>'N',
            'estado_empresa'=>'N', 'estado_ruc'=>'N', 'estado_direccion'=>'N', 'estado_numero_cuenta'=>'N']);
        }

        /*Ingreso: se registra dos registros en tabla cargo*/
        /*if (Cargo::count()==0) {
            # code...
            $cargos = Cargo::insert(['cargo'=>'Usuario', 'descripcion'=>'Encargado para ingresar, consultar y reportar.'],
            ['cargo'=>'Administrador', 'descripcion'=>'Encargado para configurar el sistema de acuerdo a sus politicas.']);
        }*/
        
        return view('home');
    }
}
