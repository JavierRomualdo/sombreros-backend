<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Session;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::all();
        return view ('gastronomica/sombreros/clientes/cliente')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/clientes/create');
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
        Cliente::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Clientes\ClienteController@index');
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
        $cliente = Cliente::FindOrFail($id);

        return view ('gastronomica.sombreros.clientes.show')->with('cliente', $cliente);
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
        $cliente = Cliente::FindOrFail($id);
        return View('gastronomica.sombreros.clientes.edit')->with('cliente', $cliente);
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
            'nombres'=>'required|max:100',
            'dni'=>'required|max:8|unique:cliente,dni,'.$id,
            'direccion'=>'max:100',
            'telefono'=>'required|max:9',
          ]);
        //
        Cliente::where('id',$id)->update(['nombres'=>$request->nombres, 'dni'=>$request->dni,
          'direccion'=>$request->direccion,'telefono'=>$request->telefono]);
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Clientes\ClienteController@index');
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
        $venta = Venta::select('id')->where('idEmpleado','=',$id)->get();
        if ($venta!=null) {
          # code...
          Session::flash('error','No se puede eliminar');
        } else {
          $cliente = Cliente::FindOrFail($id);
          $cliente->delete();
          Session::flash('delete','Se ha eliminado correctamente');
        }
        return redirect()->action('Cientes\ClienteController@index');
    }
}
