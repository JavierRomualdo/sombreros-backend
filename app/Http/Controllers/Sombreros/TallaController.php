<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\http\Requests\Talla\TallaCreateRequest;
use App\http\Requests\Talla\TallaUpdateRequest;
use Session;

class TallaController extends Controller
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
        $tallas = Tallas::all();//all()->take(10)
        return view ('gastronomica/sombreros/tallas/talla')->with('tallas', $tallas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/tallas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TallaCreateRequest $request)
    {
        //
        Tallas::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\TallaController@index');
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
        $tallas = Tallas::FindOrFail($id);
        return View('gastronomica\sombreros\tallas\show')->With('talla', $tallas);
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
        $tallas = Tallas::FindOrFail($id);
        return View('gastronomica\sombreros\tallas\edit', array('talla'=>$tallas));
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
          'talla'=>'required|max:50|unique:tallas,talla,'.$id,
          'descripcion'=>'max:100',
        ]);
        //
        $tallas = Tallas::FindOrFail($id);
        $input = $request->all();
        $tallas->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\TallaController@index');
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
        $tallas = Tallas::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idTalla','=',$tallas->id)->first();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-talla','No se puede eliminar');
          return redirect()->action('Sombreros\TallaController@index');
        } else {
          $tallas->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\TallaController@index');
        }
    }
}
