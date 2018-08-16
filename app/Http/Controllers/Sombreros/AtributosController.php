<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sombrero;
use App\Models\Atributos;
use Session;

class AtributosController extends Controller
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
        //$atributos = Atributos::all();//all()
        $atributos = Atributos::FindOrFail(1);
        return view ('gastronomica/configuracion/atributos/atributo')->with('atributos', $atributos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'igv'=>'required',
            'margenganancia'=>'required',
            'preciominimo'=>'required',
            'preciomaximo'=>'required',
            'preciomaximo'=>'required',
            'costorepmaximo'=>'required',
            'costoserviciorep'=>'required',
            'descuentoventa'=>'required',
            'descuentoextra'=>'required',
            'comision'=>'required',
          ]);
          //
          //echo($request->rangopr1." - ".$request->mensajepr1." - ".$request->colorpr1);
          $atributos = Atributos::FindOrFail($id);
          $input = $request->all();
          $atributos->fill($input)->save();

          Session::flash('update','Se ha actualizado correctamente');
          return redirect()->action('Sombreros\AtributosController@index');
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
