<?php

namespace App\Http\Controllers\Proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Proveedor;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\ProveedorPrecio;
use App\http\Requests\ProveedorPrecio\ProveedorPrecioCreateRequest;
use Session;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedoresprecio = ProveedorPrecio::select('proveedor_precio.id','proveedor_precio.precio',
        'proveedor.empresa','sombrero.codigo', 'sombrero.photo')->join('proveedor','proveedor.id','=',
          'proveedor_precio.idProveedor')->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')->get();
        return view ('gastronomica/proveedores/precios/precios')->with('proveedoresprecio', $proveedoresprecio);
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
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return view('gastronomica/proveedores/precios/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas));
    }

    public function mostrarCodigo($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code...
      $datos = Sombrero::where('idModelo','=', $modelo_id, 'and', 'idTejido','=',$tejido_id,
            'and','idMaterial','=',$material_id,'and','idPublicoDirigido','=',$publico_id,
            'and','idTalla','=',$talla_id)->get();
      return response()->json($datos);
      /*$datos = DB::select("call pa_ingresarStockSombreros($idProveedor,$idModelo,$idTejido,$idPublico,
               $idMaterial,$idTalla,$idProveedor)");*/
    }

    public function ajaxSombrero($codSombrero)
    {
      # code...
      $datos = Sombrero::where('codigo','=',$codSombrero)->get();
      return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorPrecioCreateRequest $request)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();
        ProveedorPrecio::insert(['idProveedor'=>$request->idProveedor,
          'idSombrero'=>$sombrero->id, 'precio'=>$request->precio_compra]);
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Proveedores\PreciosController@index');

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
        $proeveedoresprecio = ProveedorPrecio::FindOrFail($id);
        $sombreros = Sombrero::FindOrFail($proeveedoresprecio->idSombrero);
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return View('gastronomica.proveedores.precios.edit', array('proveedorprecio'=>$proeveedoresprecio,
        'modelo'=>$modelos,'sombrero'=>$sombreros,'tejido'=>$tejidos,'material'=>$materiales,
        'publicodirigido'=>$publicosdirigido,'talla'=>$tallas,'proveedor'=>$proveedores));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorPrecioCreateRequest $request, $id)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();

        ProveedorPrecio::where('id',$id)->update(['idProveedor'=>$request->idProveedor,
          'idSombrero'=>$sombrero->id, 'precio'=>$request->precio_compra]);
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Proveedores\PreciosController@index');
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
