<?php

namespace App\Http\Controllers\Empleados;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Encargo;
use App\http\Requests\Trabajador\TrabajadorCreateRequest;
use Session;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empleados = Empleado::select('empleado.id','encargo.nombre as encargo','empleado.nombres',
        'empleado.apellidos','empleado.dni','empleado.direccion','empleado.telefono','empleado.email')
        ->join('encargo','encargo.id','=','empleado.idEncargo')->get();
        return view ('gastronomica/sombreros/empleados/empleado')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $encargos = Encargo::pluck('nombre','id')->prepend('Seleccione el Encargo...');
        return view ('gastronomica/sombreros/empleados/create')->with('encargo', $encargos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrabajadorCreateRequest $request)
    {
        //
        Empleado::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Empleados\EmpleadoController@index');
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
        $empleado = Empleado::FindOrFail($id);
        $encargo = Encargo::FindOrFail($empleado->idEncargo);
        //$proveedor_precio = ProveedorPrecio::select("proveedor.idProveedor")
        //->where("proveedor_precio.idSombrero","=",$id)->first();
        //$proveedores = Proveedor::FindOrFail($proveedor_precio->idProveedor);

        return View('gastronomica.sombreros.empleados.show', array('empleado'=>$empleado,'encargo'=>$encargo));
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
        $empleado = Empleado::FindOrFail($id);
        $encargos = Encargo::pluck('nombre','id')->prepend('Seleccione el Encargo...');
        return View('gastronomica.sombreros.empleados.edit', array('empleado'=>$empleado,'encargo'=>$encargos));
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
            'idEncargo'=>'required|not_in:0',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'dni'=>'required|max:8|unique:empleado,dni,'.$id,
            'direccion'=>'max:100',
            'telefono'=>'required|max:9',
            'email'=>'max:50',
            'descripcion'=>'max:100',
          ]);
        //
        Empleado::where('id',$id)->update(['idEncargo'=>$request->idEncargo,
          'nombres'=>$request->nombres, 'apellidos'=>$request->apellidos, 'dni'=>$request->dni,
          'direccion'=>$request->direccion,'telefono'=>$request->telefono,'email'=>$request->email]);
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Empleados\EmpleadoController@index');
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
          $empleados = Empleado::FindOrFail($id);
          $empleados->delete();
          Session::flash('delete','Se ha eliminado correctamente');
        }
        return redirect()->action('Sombreros\SombreroController@index');
    }
}
