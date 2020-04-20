<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Particular;
use App\Telefono;
use App\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroParticularMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParticularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }
        
        return view('intranet/clientes');
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

        try {
            DB::beginTransaction();
            $validarEmail = Particular::where('email','=',$request->correo)->exists();
            $validarRut = Particular::where('rut_particular','=',$request->rut_particular)->exists();
            if ($validarEmail) {
                $mensajeError = 'El correo ya existe, por favor ingrese un correo que no se encuentre registrado';
                return view('presentacion.registro',compact('mensajeError'));
            }else if($validarEmail && $validarRut){
                $mensajeError = 'El correo y el Rut ya existe, por favor seleccione que a olvidado la contraseña o contactese con servicio al cliente';
                return view('presentacion.registro',compact('mensajeError'));
            }else{
                $mensajeError = 'El ruT ya existe, inicie sesión o contactese con servicio al cliente';
                return view('presentacion.registro',compact('mensajeError'));
            }

            $particular = new Particular;
            $particular->rut_particular = $request->rut_particular;
            $particular->nombre_particular = $request->nombre_particular;
            $particular->apellido_paterno = $request->apellido_paterno;
            $particular->email = $request->correo;
            $particular->contraseña = $request->contrasena_particular;
            $particular->save();

            $telefono = new Telefono;
            $telefono->numero_telefono = $request->telefono;
            $telefono->particular_id = $particular->id_particular;
            $telefono->save();

            $data = new \stdClass();
            $data->codigo = $particular->id_particular;
            $data->run = $particular->rut_particular;
            $data->contrasena = $particular->contraseña;
            Mail::to($particular->email)->send(new RegistroParticularMail($data));

            DB::commit();

            $mensaje = 'Su código de cliente es '. $particular->id_particular;

            return view('presentacion.registro',compact('mensaje'));
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            notify()->error('Error en el modelo');
            return view('presentacion.registro');
        } catch (QueryException $ex){
            DB::rollback();
            notify()->error('Error en la consulta');
            return view('presentacion.registro');
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
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }

        try {
            $particular = Particular::where('id_particular','=',$id)->firstOrFail();
            $telefono = Telefono::where('particular_id','=',$id)->first();

            return view('intranet.clientes.perfil.edit',compact('particular','telefono'));
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return view('intranet.clientes.index');
        } catch (QueryException $ex){
            DB::rollback();
            return view('intranet.clientes.index');
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
        if (!Session::has('idUsuario') && !Session::has('rut')) {
            return redirect('/cliente/login');
        }
        
        try {
            DB::beginTransaction();

            $particular = Particular::find(Crypt::decrypt($id));
            $particular->nombre_particular = $request->nombre_particular;
            $particular->apellido_paterno = $request->apellido_paterno;
            $particular->email = $request->email;
            $particular->contraseña = $request->contrasena;
            $particular->save();

            $telefonoEdit = Telefono::where('particular_id','=',$particular->id_particular)->get();
            $telefonoExiste = Telefono::where('particular_id','=',$particular->id_particular)->exists();
            //Tamaño del arreglo telefono
            $tamañoTelefono =count($request->telefono);
            
            if ($telefonoExiste) {
                
                //Obtener ID en caso de que exista el o los objetos
                foreach ($telefonoEdit as $telID) {
                    $idTelefono[] = $telID->id_telefono;
                }
                
                //Obtener tamaño del objeto.
                $tamañoTelefonoObject = count($idTelefono);

                //Editar el o los telefonos.
                for ($i=0; $i < $tamañoTelefono; $i++) { 
                    for ($x=0; $x < $tamañoTelefonoObject; $x++) { 
                        DB::update('update telefono set numero_telefono = ? where particular_id = ? and id_telefono = ?', [$request->telefono[$i],$telefonoEdit->particular_id,$idTelefono[$x]]);
                    }
                }
                
            }else{
                
                foreach ($request->telefono as $insertarNuevo) {
                    $telefono = new Telefono();
                    $telefono->numero_telefono = $insertarNuevo;
                    $telefono->particular_id = $particular->id_particular;
                    $telefono->save();
                }
                
            }

            DB::commit();

            return redirect('/intranet/clientes');
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            notify()->error('Error en el modelo');
            return view('intranet.clientes.perfil.edit');
        } catch (QueryException $ex){
            DB::rollback();
            notify()->error('Error en el modelo');
            return view('intranet.clientes.perfil.edit');
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
