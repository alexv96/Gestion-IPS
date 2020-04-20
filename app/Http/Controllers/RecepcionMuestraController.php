<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\TipoAnalisis;
use App\AnalisisMuestra;
use App\ResultadoAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RecepcionMuestraController extends Controller
{
    //CLIENTE
    public function index(){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }

        DB::beginTransaction();
        try {
            if (session('tipoUsuario') == '1A') {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','analisis_muestra.empresa_codigoEmpresa',
                                            'analisis_muestra.cliente_codigoCliente','estado_resultado.tipo_estado')
                                            ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                            ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                            ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                            ->where('empresa_codigoEmpresa','=',session('idUsuario'))
                                            ->get();
            } else {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','analisis_muestra.empresa_codigoEmpresa',
                                'analisis_muestra.cliente_codigoCliente','estado_resultado.tipo_estado')
                                ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                ->where('cliente_codigoCliente','=',session('idUsuario'))
                                ->get();
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

    public function buscarMuestra(Request $request){
        if ($request->ajax()) {
            if(session('tipoUsuario') == '1A'){
                $buscadorMuestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra')
                ->where('id_analisisMuestra','LIKE','%'.$request->buscador.'%')
                ->where('empresa_codigoEmpresa','=',session('idUsuario'))->get();
            }else{
                $buscadorMuestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra')
                                ->where('id_analisisMuestra','LIKE','%'.$request->buscador.'%')
                                ->where('cliente_codigoCliente','=',session('idUsuario'))->get();
            }
            
            return \response()->json($buscadorMuestra);
        }else{
            return response()->json(['status' => false, 'message' => 'Sin permiso de acceso'], 401);
        }
    }

    public function create(){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }

        $tipoAnalisis = TipoAnalisis::orderby('nombre_analisis','asc')->get();
        return view('intranet.clientes.create',compact('tipoAnalisis'));
    }

    public function store(Request $request){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }

        DB::beginTransaction();
        try {
            $recepcion = new AnalisisMuestra;
            $recepcion->temperatura_muestra = $request->temperatura;
            $recepcion->cantidad_muestra = $request->cantidad;

            if (session('tipoUsuario') == '1B') {
                $recepcion->cliente_codigoCliente = session('idUsuario');
            }else{
                $recepcion->empresa_codigoEmpresa = session('idUsuario');
            }

            $recepcion->save();

            DB::commit();

            notify()->success('Muestra recepcionada con exito','Exito!!.',  ['timeOut' => 10000]);
            return view('intranet.clientes.create');
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return view('intranet.clientes.create');
        } catch (QueryException $ex){
            DB::rollback();
            return view('intranet.clientes.create');
        }
    }

    public function show($id){
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }
        try{
            $resultadosAnalisis = ResultadoAnalisis::select('resultado_analisis.muestra_id','resultado_analisis.PPM','tipo_analisis.nombre_analisis')
                                        ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                        ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                        ->join('tipo_analisis','tipo_analisis.id_tipoAnalisis','=','resultado_analisis.tipoAnalisis_id')
                                        //->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                        ->where('resultado_analisis.muestra_id','=',$id)->get();
            
            $mostrarID = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra')
                                    ->where('id_analisisMuestra','=',$id)->firstOrFail();

            return view('intranet.clientes.show',compact('resultadosAnalisis','mostrarID'));
        }catch (ModelNotFoundException $e) {
            DB::rollback();
            notify()->error('Error al mostrar los resultados');
            return redirect('/intranet/clientes');
        } catch (QueryException $ex){
            DB::rollback();
            notify()->error('Error al encontrar resultados');
            return redirect('/intranet/clientes');
        }
        
    }

    //BUSCADOR AJAX PARA RECARGAR TABLA CON LOS DATOS.
    public function cargarDatos(Request $request, $id){
        if ($request->ajax()) {
            if (session('tipoUsuario') == '1A') {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                            ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                            ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                            ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                            ->where('empresa_codigoEmpresa','=',session('idUsuario'))
                                            ->where('resultado_analisis.muestra_id','=',$id)
                                            ->get();
                return response()->json($buscadorMuestra);
            } else {
                $buscadorMuestra = ResultadoAnalisis::select('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                ->join('estado_resultado','estado_resultado.id_estadoResultado','=','resultado_analisis.estado_id')
                                ->groupBy('resultado_analisis.muestra_id','estado_resultado.tipo_estado')
                                ->where('cliente_codigoCliente','=',session('idUsuario'))
                                ->where('resultado_analisis.muestra_id','=',$id)
                                ->get();
                return response()->json($buscadorMuestra);
            }
            
        } else {
            return response()->json(['status' => false, 'message' => 'Sin permiso de acceso'], 401);
        }
        
    }
}
