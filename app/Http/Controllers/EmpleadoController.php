<?php

namespace App\Http\Controllers;

use DB;
use App\Rol;
use Session;
use App\Empleado;
use App\EstadoEmpleado;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroEmpleadoMail;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }
        
        $estados = EstadoEmpleado::all();
        $empleados = Empleado::select('empleados.id_empleado','empleados.nombre','empleados.apellido_paterno',
                                    'empleados.apellido_materno','roles.descripcion_rol','estado_empleado.descripcion_estado')
                        ->join('roles','roles.id_rol','=','empleados.rol_id')
                        ->join('estado_empleado','estado_empleado.id_estado','=','empleados.estado_id')->get();
        
        return view('empleados.index',compact('empleados','estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        $roles = Rol::all();
        return view('empleados.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        $roles = Rol::all();
        try {
            DB::beginTransaction();
            $rut = $request->rut;
            $existe = Empleado::select('rut_empleado')->where('rut_empleado',$rut)->exists();
            
            if ($existe) {
                DB::rollback();
                notify()->error('El empleado a registrar ya se encuentra registrado',  ['timeOut' => 10000]);
                return redirect('/empleados');
            }

            $empleado = new Empleado;
            $empleado->rut_empleado = $request->rut_empleado;
            $empleado->nombre = $request->nombre;
            $empleado->apellido_paterno = $request->apellido_paterno;
            $empleado->apellido_materno = $request->apellido_materno;
            $empleado->contrasena = $request->contrasena;
            $empleado->email = $request->email;
            $empleado->rol_id = $request->rol;
            $empleado->estado_id = 1;
            $empleado->save();

            $data = new \stdClass();
            $data->correo = $empleado->email;
            $data->contrasena = $empleado->contrasena;
            Mail::to($empleado->email)->send(new RegistroEmpleadoMail($data));

            DB::commit();
            notify()->success('Empleado agregado exitosamente','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/empleados');
        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/empleados');
        } catch (ModelNotFoundException $ex){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return view('empleados.create',compact('roles'));
        }
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }

        $roles = Rol::all();
        try {
            $empleadoID = Crypt::decrypt($id);
            $empleado = Empleado::where('id_empleado','=',$empleadoID)->firstOrFail();
            return view('empleados.edit',compact('empleado','roles'));
        
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            return redirect('/empleados');
        } catch (QueryException $ex){
            notify()->danger('Error al realizar la consulta en la BD');
            return redirect('/empleados');
        }
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        try {
            DB::beginTransaction();

            $empleadoID = Crypt::decrypt($id);
            $empleado = Empleado::FindOrFail($empleadoID);
            $empleado->nombre = $request->nombre;
            $empleado->apellido_paterno = $request->apellido_paterno;
            $empleado->apellido_materno = $request->apellido_materno;
            $empleado->contrasena = $request->contrasena;
            $empleado->email = $request->email;
            $empleado->rol_id = $request->rol;
            $empleado->save();

            DB::commit();
            notify()->success('Empleado modificado '. $empleado->nombre . ' exitosamente','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/empleados');
        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/empleados');
        } catch (ModelNotFoundException $ex){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/empleados');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }
        
        try {
            DB::beginTransaction();

            $idEmpleado = Crypt::decrypt($id);
            $camboiarEstado = Empleado::where('id_empleado','=',$idEmpleado)->firstOrFail();
            $camboiarEstado->estado_id = $request->estado;
            $camboiarEstado->save();
            
            DB::commit();

            notify()->success('Empleado dada de baja exitosamente','Exito!', ['timeOut' => 10000]);
            return redirect('/empleados');
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al eliminar empleado');
            DB::rollback();
            return redirect('/empleados');
        }
    }
}
