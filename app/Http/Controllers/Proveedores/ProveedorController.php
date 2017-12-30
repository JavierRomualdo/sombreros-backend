<?php

namespace App\Http\Controllers\Proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\http\Requests\Proveedor\ProveedorCreateRequest;
use App\http\Requests\Proveedor\ProveedorUpdateRequest;

use App\Models\Proveedor;
use App\Models\EstadosProveedor;
use App\Models\Sombrero;
use Session;

class ProveedorController extends Controller
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
    /*public function manageItemAjax()
    {
      # code...
      return view ('gastronomica/proveedores/proveedores/proveedor');
    }*/

    /*public function index(Request $request)
    {
      # code...
      $proveedores = Proveedor::all();
      return response()->json($proveedores);
    }*/
    public function index()
    {
    //    $proveedores = Proveedor::all();
    //    return response()->json($proveedores);
        //
        //$proveedores = Proveedor::all();//all() paginate(5)
        //return View('gastronomica/proveedores/proveedores/proveedor')->with('proveedor', $proveedores);
        return view ('gastronomica/proveedores/proveedores/proveedor');

        /* De VUEjs
        $proveedores = Proveedor::all();
        return response()->json([
          'proveedores'=>$proveedores
        ]);*/
    }

    public function listall()
    {
      # code...
      $proveedores = Proveedor::paginate(5);//all() paginate(5)
      return View('gastronomica/proveedores/proveedores/listall')->with('proveedores', $proveedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Session::flash('save','Aviso: Los campos que se encuentran con (*) son obligatorios');
        return View('gastronomica/proveedores/proveedores/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validamos que minimo un dato sea agregado en la tabla
        if ($request->titular=="" && $request->dni_titular=="" && $request->telefono_titular=="" &&
              $request->email_titular=="" && $request->segundo_contacto=="" && $request->dni_segundo=="" &&
              $request->telefono_segundo=="" && $request->email_segundo=="" && $request->empresa=="" &&
              $request->ruc=="" && $request->direccion=="" && $request->numero_cuenta=="") {
          # code...
          Session::flash('save','Aviso: Se debe guardar minimo un dato.');
          return redirect()->action('Proveedores\ProveedorController@index');
        } else {
          Proveedor::create($request->all());
          Session::flash('save','Se ha creado correctamente');
          return redirect()->action('Proveedores\ProveedorController@index');
        }

        //$proveedores = Proveedor::create($request->all());
        //return response()->json($proveedores);
        //
        /*Proveedor::create($request->all());
        Session::flash('save', "Se ha creado correctamente");
        return redirect()->action('Proveedores\ProveedorController@index');*/

        /* De VUEjs
        $proveedor = Proveedor::create([
          'empresa' => $request->input('empresa'),
          'ruc' => $request->input('ruc'),
          'direccion' => $request->input('direccion'),
          'telefono' => $request->input('telefono'),
          'correo' => $request->input('correo'),
          'fecha_ingreso' => $request->input('fecha_ingreso'),
          'descripcion' => $request->input('descripcion'),
          'estado' => $request->input('estado')
        ]);
        return response()->json([
          'message' => 'proveedor created successfully',
          'proveedor' => $proveedor
        ]);*/
        #$result = Proveedor::create($request->all());
        #if ($request->ajax()) {
          # code...
          #$result = Proveedor::create($request->all());
          /*if ($result) {
            # code...
            return response()->json(['success'=>'true']);
          } else{
            return response()->json(['success'=>'false']);
          }*/
        #}
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
        $proveedores = Proveedor::FindOrFail($id);
        return View('gastronomica\proveedores\proveedores\show')->with('proveedor', $proveedores);
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
        $proveedores = Proveedor::FindOrFail($id);
        return View('gastronomica\proveedores\proveedores\edit', array('proveedor'=>$proveedores));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function datos(Request $request)
     {
       # code...
       Session::flash('save','Aviso: Eliga los campos ha de ser obligatorios.');
       return view ('gastronomica/proveedores/proveedores/datos');
     }

     public function ajaxEstados($id)
     {
       # code...
       $estados = EstadosProveedor::where('id','=',$id)->get();
       return response()->json($estados);
     }

     public function ajaxGuardarEstados($nombre_titular,$dni_titular,$telefono_titular,$email_titular,$nombre_segundo,$dni_segundo,$telefono_segundo,$email_segundo,$empresa,$ruc,$direccion,$numero_cuenta)
     {
       # code...
       EstadosProveedor::where('id',1)->update(['estado_titular'=>$nombre_titular,'estado_dni_titular'=>$dni_titular,
        'estado_telefono_titular'=>$telefono_titular,'estado_email_titular'=>$email_titular,
        'estado_segundo_contacto'=>$nombre_segundo,'estado_dni_segundo'=>$dni_segundo,
        'estado_telefono_segundo'=>$telefono_segundo,'estado_email_segundo'=>$email_segundo,'estado_empresa'=>$empresa,
        'estado_ruc'=>$ruc,'estado_direccion'=>$direccion,'estado_numero_cuenta'=>$numero_cuenta]);
        Session::flash('update','Se ha actualizado los estados correctamente');
        $estados = EstadosProveedor::where('id','=',1)->get();
        return response()->json($estados);

     }

     public function ver($id)
     {
       # code...
       $proveedores = Proveedor::find($id);
       return View('gastronomica.proveedores.proveedores.ver')->with('proveedor',$proveedores);
     }

     public function datoseditar(Request $request)
     {
       # code... seleccionamos todos los estados de la primera fila

       return view ('gastronomica/proveedores/proveedores/datoseditar');
     }

    public function update(Request $request, $id)
    {
        //
        /*$validar = $request->validate([
          'nombres'=>'required|max:50',
          'apellidos'=>'required|max:50',
          'dni'=>'required|max:8|unique:proveedor,dni,'.$id,
          'empresa'=>'required|max:70|unique:proveedor,empresa,'.$id,
          'ruc'=>'required|min:11|max:11|unique:proveedor,ruc,'.$id,
          'direccion'=>'required|max:80',
          'telefono'=>'max:15',
          'correo'=>'max:50',
          'fecha_ingreso'=>'required',
        ]);*/
        //
        $proveedores = Proveedor::FindOrFail($id);
        $input = $request->all();
        $proveedores->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Proveedores\ProveedorController@index');
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
        $proveedores = Proveedor::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idProveedor','=',$proveedores->id)->get();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-proveedor','No se puede eliminar');
          return redirect()->action('Proveedores\ProveedorController@index');
        } else {
          $proveedores->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          #Session::flash('delete', "Se ha eliminado correctamente");
          return redirect()->action('Proveedores\ProveedorController@index');
        }
    }
}
