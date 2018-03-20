<?php

namespace App\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComisionEmpleado;
use App\Models\Encargo;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\Empleado;
use App\Models\Temporada;

use Session;

class EmpleadoComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total')
        
        $cantEmpleados = Empleado::count();
        $cantSombreros = Sombrero::count();
        $empleados = Empleado::select('nombres','id')->get();
        $sombreros = Sombrero::select('codigo','id','precio_venta')->get();

        /*$comisiones = ComisionEmpleado::select('comisionempleado.id','empleado.nombres','encargo.nombre','sombrero.codigo',
        'sombrero.photo','sombrero.precio_venta','comisionempleado.porcentaje','comisionempleado.descripcion')
        ->join('empleado','empleado.id','=','comisionempleado.idEmpleado')
        ->join('encargo','encargo.id','=','empleado.idEncargo')
        ->join('sombrero','sombrero.id','=','comisionempleado.idSombrero')->paginate(5);*/

        $temporadas = Temporada::pluck('temporada','id')->prepend('Seleccione la temporada...');
        
        return view ('gastronomica/sombreros/comisionempleado/comision',
        array('empleados'=>$empleados,'sombreros'=>$sombreros,
        'cantidadEmpleado'=>$cantEmpleados,'cantidadSombreros'=>$cantSombreros,'temporada'=>$temporadas));

    }

    public function mostrarComisiones($idTemporada){
        $datos = ComisionEmpleado::select('comisionempleado.id','comisionempleado.idSombrero','comisionempleado.idEmpleado',
        'comisionempleado.porcentaje','sombrero.precio_venta')
        ->join('temporada','temporada.id','=','comisionempleado.idTemporada')
        ->join('sombrero','sombrero.id','=','comisionempleado.idSombrero')
        ->where('comisionempleado.idTemporada','=',$idTemporada)->get();
        return response()->json($datos);
    }

    public function mostrarComision($idEmpleadoComision){
        $datos = ComisionEmpleado::select('comisionempleado.porcentaje')
        ->where('comisionempleado.id','=',$idEmpleadoComision)->get();

        return response()->json($datos);        
    }

    public function nuevaComision($idSombrero, $idEmpleado, $idTemporada, $porcentaje){
        ComisionEmpleado::insert(['idEmpleado'=>$idEmpleado,'idSombrero'=>$idSombrero,'idTemporada'=>$idTemporada,
            'porcentaje'=>$porcentaje]);

        $datos = ComisionEmpleado::all()->last();
        return response()->json($datos);
    }

    public function cambiarComision($idEmpleadoComision, $porcentaje){
        ComisionEmpleado::where('id',$idEmpleadoComision)->update(['porcentaje'=>$porcentaje]);
        
        $datos = ComisionEmpleado::select('comisionempleado.idSombrero','comisionempleado.idEmpleado','comisionempleado.porcentaje')
            ->where('comisionempleado.id','=',$idEmpleadoComision)->get();
        
        return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $temporadas = Temporada::pluck('temporada','id')->prepend('Seleccione la temporada...');

        return view('gastronomica/sombreros/comisionempleado/create', array('modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,
        'publicodirigido'=>$publicosdirigido,'talla'=>$tallas,'temporada'=>$temporadas));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();
        $empleado = Empleado::where('nombres','=',$request->nombres)->first();
        ComisionEmpleado::insert(['idEmpleado'=>$empleado->id,'idSombrero'=>$sombrero->id, 'idTemporada'=>$request->idTemporada,
        'porcentaje'=>$request->porcentaje,'descripcion'=>$request->descripcion]);
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Empleados\EmpleadoComisionController@index');
    }

    public function mostrarNombresEmpleados()
    {
        # code...
        $nombres = Empleado::select('nombres')->get();
        return response()->json($nombres);
    }

    public function mostrarDatosSombreroComision($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code..
      $datos = Sombrero::select('codigo','precio_venta')
      ->where('sombrero.idTalla','=',$talla_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->get();
      
      /*$datos = Sombrero::select('codigo')
      ->where('sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idTalla','=',$talla_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->get();*/

      return response()->json($datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $comision = ComisionEmpleado::select('comisionempleado.id','empleado.nombres','encargo.nombre','sombrero.codigo',
        'sombrero.photo','sombrero.precio_venta','comisionempleado.porcentaje','comisionempleado.descripcion')
        ->join('empleado','empleado.id','=','comisionempleado.idEmpleado')
        ->join('encargo','encargo.id','=','empleado.idEncargo')
        ->join('sombrero','sombrero.id','=','comisionempleado.idSombrero')->first();
        return view('gastronomica/sombreros/comisionempleado/show')->with('comision',$comision);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $comision = ComisionEmpleado::FindOrFail($id);
        $sombrero = Sombrero::FindOrFail($comision->idSombrero);
        $empleado = Empleado::FindOrFail($comision->idEmpleado);
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        return view('gastronomica/sombreros/comisionempleado/edit', array('comision'=>$comision,'empleado'=>$empleado, 'sombrero'=>$sombrero,
        'modelo'=>$modelos,'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,'talla'=>$tallas));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();
        $empleado = Empleado::where('nombres','=',$request->nombres)->first();
        ComisionEmpleado::where('id',$id)->update(['idEmpleado'=>$empleado->id, 'idSombrero'=>$sombrero->id, 
          'porcentaje'=>$request->porcentaje, 'descripcion'=>$request->descripcion]);
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Empleados\EmpleadoComisionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
