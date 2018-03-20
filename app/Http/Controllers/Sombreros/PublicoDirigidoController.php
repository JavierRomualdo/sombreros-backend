<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sombrero;
use App\Models\PublicoDirigido;
use App\http\Requests\PublicoDirigido\PublicoDirigidoCreateRequest;
use App\http\Requests\PublicoDirigido\PublicoDirigidoUpdateRequest;
use Session;

class PublicoDirigidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       # code...
       $this->middleware('auth');
     }

    public function index()
    {
        //
        $publicosdirigido = PublicoDirigido::all()->take(10);//all()
        return view ('gastronomica/sombreros/publicodirigido/publicodirigido')->with('publicosdirigido', $publicosdirigido);
    }

    public function mostrarCodigo($id){
      $datos = PublicoDirigido::select("publicodirigido.codigo")->where('publicodirigido.id','=',$id)->get();
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
        return view ('gastronomica/sombreros/publicodirigido/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicoDirigidoCreateRequest $request)
    {
        //
        PublicoDirigido::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\PublicoDirigidoController@index');
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
        $publicosdirigido = PublicoDirigido::FindOrFail($id);
        return View('gastronomica\sombreros\publicodirigido\show')->With('publicodirigido', $publicosdirigido);
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
        $publicosdirigido = PublicoDirigido::FindOrFail($id);
        return View('gastronomica\sombreros\publicodirigido\edit', array('publicodirigido'=>$publicosdirigido));
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
        $validar = $request->validate([
          'publico'=>'required|unique:publicodirigido,publico,'.$id,
          'descripcion'=>'max:100',
        ]);
        //
        $publicosdirigido = PublicoDirigido::FindOrFail($id);
        $input = $request->all();
        $publicosdirigido->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\PublicoDirigidoController@index');
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
        $publicosdirigido = PublicoDirigido::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idPublicoDirigido','=',$publicosdirigido->id)->first();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-publico','No se puede eliminar');
          return redirect()->action('Sombreros\PublicoDirigidoController@index');
        } else {
          $publicosdirigido->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\PublicoDirigidoController@index');
        }

    }
}
