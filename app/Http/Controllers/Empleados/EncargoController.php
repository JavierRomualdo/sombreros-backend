<?php

namespace App\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Encargo;
use App\Models\Empleado;
use App\http\Requests\Encargo\EncargoCreateRequest;
use Session;

class EncargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $encargos = Encargo::all()->take(10);//all()
        return view ('gastronomica/sombreros/encargos/encargo')->with('encargos', $encargos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/encargos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncargoCreateRequest $request)
    {
        //
        Encargo::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Empleados\EncargoController@index');
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
        $encargos = Encargo::FindOrFail($id);
        return View('gastronomica\sombreros\encargos\show')->With('encargo', $encargos);
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
        $encargos = Encargo::FindOrFail($id);
        return View('gastronomica\sombreros\encargos\edit')->With('encargo', $encargos);
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
            'nombre'=>'required|unique:encargo,nombre,'.$id,
            'descripcion'=>'max:100',
          ]);
          //
          $encargo = Encargo::FindOrFail($id);
          $input = $request->all();
          $encargo->fill($input)->save();
          Session::flash('update','Se ha actualizado correctamente');
          return redirect()->action('Empleados\EncargoController@index');
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
        $encargos = Encargo::FindOrFail($id);
        $empleados = Empleado::select('id')->where('idEncargo','=',$encargos->id)->first();
        if ($empleados!=null) {
          # code...
          Session::flash('error-modelo','No se puede eliminar');
        } else {
          $encargos->delete();
          Session::flash('delete','Se ha eliminado correctamente');
        }
        return redirect()->action('Empleados\EncargoController@index');
    }
}
