<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Empleado;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\EmpleadoPerfilRequest;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }
        $roles = Rol::all();
        $empleado = Empleado::where('id_empleado','=',$id)->firstOrFail();

        return view('empleados.perfil.edit',compact('empleado','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoPerfilRequest $request, $id)
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
            $empleado->save();

            DB::commit();
            notify()->success('Perfil modificado '. $empleado->nombre . ' exitosamente','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/dashboard');
        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/dashboard');
        } catch (ModelNotFoundException $ex){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/dashboard');
        }
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
