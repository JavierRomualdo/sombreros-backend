<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EstadosProveedor;
use App\Models\PedidoReposicion;
use DB;

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
        $pedidosreposicion = PedidoReposicion::select(DB::raw('COUNT(id) as cantidad'))
        ->where('estado','=','A')->first();

        //$now = new \DateTime();
        //$fecha =$now->format('Y-m-d');

       /*$temporada = Temporada::select("temporada.photo")
       ->whereBetween($fecha,['temporada.fecha_inicio','temporada.fecha_fin'])->first();*/
        /*Ingreso: se registra dos registros en tabla cargo*/
        /*if (Cargo::count()==0) {
            # code...
            $cargos = Cargo::insert(['cargo'=>'Usuario', 'descripcion'=>'Encargado para ingresar, consultar y reportar.'],
            ['cargo'=>'Administrador', 'descripcion'=>'Encargado para configurar el sistema de acuerdo a sus politicas.']);
        }*/
        //echo($temporada);
        return view('home', array('pedidosreposicion'=>$pedidosreposicion));//->with('temporada',$temporada)
    }
}
