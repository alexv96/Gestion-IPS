<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Empleado;
use App\Particular;
use App\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginController extends Controller
{
    /* Login Trabajadores */
    public function index(){
        if (Session::has('correo') && Session::has('contrasena')) {
            return redirect('/dashboard');
        }

        return view('presentacion.login');
    }

    public function login(LoginRequest $request){
        try {
            $usuario = Empleado::where('email','=',$request->correo)
                        ->where('contrasena','=',$request->contrasena)
                        ->firstOrFail();

            if ($usuario->estado_id === 2) {
                notify()->info('Cuenta no activada.');
                return redirect('/login');
            }

            Session::put('idEmpleado',$usuario->id_empleado);
            Session::put('nombre',$usuario->nombre);
            Session::put('apPaterno', $usuario->apellido_paterno);
            Session::put('apMaterno', $usuario->apellido_materno);
            Session::put('tipoUsuario', $usuario->rol_id);
            Session::put('correo', $usuario->email);
            Session::put('contraseña',$usuario->contrasena);

            notify()->success('Bienvenido '. $usuario->nombre);
            return redirect('/dashboard');

        } catch (QueryException $e) {
            notify()->warning('Se ha producido un error interno. Favor intente nuevamente.');
            return redirect('/login');
        } catch (ModelNotFoundException $ex){
            notify()->warning('Usuario y/o contraseña incorrecta');
            return redirect('/login');
        }
    }

    public function logout(Request $request){
        if (!Session::has('correo') && !Session::has('contrasena')) {
            return redirect('/login');
        }

        Session::put('idEmpleado',null);
        Session::put('nombre',null);
        Session::put('apPaterno', null);
        Session::put('apMaterno', null);
        Session::put('tipoUsuario', null);
        Session::put('correo', null);
        Session::put('contraseña',null);

        notify()->success('Sesión cerrada exitosamente');
        return redirect('/login');
    }

    /* LOGIN CLIENTES */
    public function loginUsuario(){
        return view('presentacion.loginUsuario');
    }

    public function loginClientes(Request $request){
        try {
            $rut = $request->rut_particular;
            $pass = $request->contrasena;
            $tipoUsuario = $request->tipo;

            switch($tipoUsuario){
                case "empresa":
                    $usuario = Empresa::where('rut_empresa','=',$rut)
                                    ->where('contrasena_empresa','=',$pass)
                                    ->firstOrFail();                
                    Session::put('idUsuario', $usuario->codigo_empresa);
                    Session::put('rut', $usuario->rut_empresa);
                    Session::put('nombre', $usuario->nombre_empresa);
                    Session::put('tipoUsuario','1A');
                    notify()->success('Bienvenido '. session('nombre'));
                    return redirect('/intranet/clientes');
                    break;

                case "particular":
                    $usuario = Particular::where('rut_particular','=',$rut)
                                        ->where('contraseña','=', $pass)
                                        ->firstOrFail();

                    Session::put('idUsuario', $usuario->id_particular);
                    Session::put('rut', $usuario->rut_particular);
                    Session::put('nombre', $usuario->nombre_particular);
                    Session::put('apPaterno', $usuario->apellido_paterno);
                    Session::put('tipoUsuario','1B');

                    notify()->success('Bienvenido '. session('nombre'));
                    return redirect('/intranet/clientes');
                    break;
                default:
                    notify()->warning('Usuario y/o contraseña incorrecta');
                    return redirect('/cliente/login');
                    break;
            }

        } catch (QueryException $e) {
            notify()->warning('Se ha producido un error interno. Favor intente nuevamente.');
            return redirect('/cliente/login');
        } catch (ModelNotFoundException $ex){
            notify()->warning('Usuario y/o contraseña incorrecta');
            return redirect('/cliente/login');
        }
    }

    public function logoutUsuario(){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }

        //Sesion USUARIOS => EMRESA / CLIENTE
        Session::put('idUsuario',null);
        Session::put('rut',null);
        Session::put('nombre',null);
        Session::put('apPaterno',null);
        Session::put('tipoUsuario',null);

        notify()->success('Sesión cerrada exitosamente');
        return redirect('/cliente/login');
    }
}
