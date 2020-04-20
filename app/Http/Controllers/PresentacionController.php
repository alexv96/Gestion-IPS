<?php

namespace App\Http\Controllers;

use DB;;
use Session;
use App\Particular;
use App\Empresa;
use App\Empleado;
use App\Noticia;
use App\Imagen;
use App\AnalisisMuestra;
use App\ResultadoAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OlvidasteContrasenaMail;
use App\Mail\ContactoMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PresentacionController extends Controller
{
    public function index(){
        $noticias = Noticia::select('noticias.id_noticia','noticias.titulo','noticias.cuerpo','imagenes.ruta')->join('imagenes','imagenes.noticia_id','=','noticias.id_noticia')->orderBy('noticias.id_noticia','DESC')->take(3)->get();
        return view('presentacion.app',compact('noticias'));
    }

    public function contacto(){
        return view('presentacion.contacto');
    }

    public function registro(){
        return view('presentacion.registro');
    }

    public function dashboard(){
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('presentacion.login');
        }
        
        $muestrasRecibidas = AnalisisMuestra::orderby('id_analisisMuestra','asc')->get();
        $analisisRecibidos = ResultadoAnalisis::select('resultado_analisis.muestra_id','analisis_muestra.empresa_codigoEmpresa',
                                                    'analisis_muestra.cliente_codigoCliente','estado_resultado.tipo_estado')
                                                ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                                ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                                ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')->get();
        
        $totalEmpleados = Empleado::count();
        $totalMuestras = AnalisisMuestra::count();
        $empresa = Empresa::count();
        $particular = Particular::count();
        $clientes = $empresa + $particular;
        return view('index',compact('muestrasRecibidas','analisisRecibidos','totalEmpleados','totalMuestras','clientes'));
    }
    
    public function intranet(){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }
        
        try {
            if (session('tipoUsuario') == '1A') {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','analisis_muestra.empresa_codigoEmpresa',
                                            'analisis_muestra.cliente_codigoCliente','estado_resultado.tipo_estado')
                                            ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                            ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                            ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                            ->where('empresa_codigoEmpresa','=',session('idUsuario'))
                                            ->paginate(10);
            } else {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','analisis_muestra.empresa_codigoEmpresa',
                                'analisis_muestra.cliente_codigoCliente','estado_resultado.tipo_estado')
                                ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                ->where('cliente_codigoCliente','=',session('idUsuario'))
                                ->paginate(10);
            }
            
            DB::commit();

            return view('intranet.clientes.index',compact('buscadorMuestra'));
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return view('intranet.clientes.index');
        } catch (QueryException $ex){
            DB::rollback();
            return view('intranet.clientes.index');
        }
    }

    public function mostrarNoticia($id)
    {
        try {
            DB::beginTransaction();

            $noticia = Noticia::select('noticias.id_noticia','noticias.titulo','noticias.cuerpo','noticias.created_at',
                                        'imagenes.ruta','imagenes.noticia_id','empleados.nombre','empleados.apellido_paterno',
                                        'empleados.apellido_materno')
                        ->join('empleados','empleados.id_empleado','=','noticias.empleado_id')
                        ->join('imagenes','imagenes.noticia_id','=','noticias.id_noticia')
                        ->where('id_noticia','=', $id)->firstOrFail();
            $ultimosPost = Noticia::select('noticias.id_noticia','noticias.titulo','imagenes.ruta','noticias.created_at')->join('imagenes','imagenes.noticia_id','=','noticias.id_noticia')->orderBy('noticias.id_noticia','DESC')->take(10)->get();
            DB::commit();
            return view('presentacion.noticia',compact("noticia",'ultimosPost'));
        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/');
        } catch (ModelNotFoundException $e){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/');
        }
    }

    public function recuperarClave(){
        return view('presentacion.recuperarContrasena');
    }

    public function clave(Request $request){
        try {
            $correo = $request->correo;
            $tipoUsuario = $request->tipo;

            switch($tipoUsuario){
                case "empresa":
                    $usuario = Empresa::where('rut_empresa','=',$correo)
                                    ->firstOrFail();                

                    notify()->success('Se ha enviado la clave a su correo.');
                    return redirect('/cliente/login');
                    break;

                case "particular":
                    $usuario = Particular::where('email','=',$correo)
                                        ->firstOrFail();

                    $data = new \stdClass();
                    $data->contrasena = $usuario->contraseña;

                    Mail::to($usuario->email)->send(new OlvidasteContrasenaMail($data));

                    notify()->success('Se ha enviado la clave a su correo.');
                    return redirect('/cliente/login');
                    break;
                case "empleado":
                    $validarCorreo = Empleado::select('empleados.email')->where('email','=',$correo)->exists();
                    
                    if ($validarCorreo) {
                        $usuario = Empleado::where('email','=',$correo)->firstOrFail();

                        $data = new \stdClass();
                        $data->contrasena = $usuario->contrasena;

                        Mail::to($usuario->email)->send(new OlvidasteContrasenaMail($data));

                        notify()->success('Se ha enviado la clave a su correo.');  
                        return redirect('/login');
                        break;
                    }

                    notify()->warning('Correo invalido');
                    return redirect('/login');
                    break;
                    
                default:
                    notify()->warning('Correo invalido');
                    if ($tipoUsuario == 'empresa' || $tipoUsuario == 'particular') {
                        return redirect('/recuperarContrasena');
                        break;
                    }else{
                        return redirect('/login');
                        break;
                    }
                    
            }
            

        } catch (QueryException $e) {
            notify()->warning('Se ha producido un error interno. Favor intente nuevamente.');
            return redirect('/recuperarContrasena');
        } /*catch (ModelNotFoundException $ex){
            notify()->warning('Correo invalido');
            return redirect('/recuperarContrasena');
        }*/
    }

    public function contactanos(Request $request){
        $data = new \stdClass();
        $data->nombre = $request->nombre;

        
        $data->apellido = ($request->apellido == 'Apellido Paterno' || $request->apellido == 'Apellido') ? null : $request->apellido;
        $data->correo = $request->correo;
        $data->mensaje = $request->mensaje;

        Mail::to('jeremiahvalezka2015@gmail.com')->bcc($request->correo)->send(new ContactoMail($data));
        return view('presentacion.contacto')->with('envioExitoso', true);
    }
}
