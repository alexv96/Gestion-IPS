<?php
/*
|--------------------------------------------------------------------------
| Web Routes / FRONT-END
|--------------------------------------------------------------------------
|
*/

Route::get('/','PresentacionController@index');
Route::get('/contacto','PresentacionController@contacto');
Route::get('/registro','PresentacionController@registro');
Route::get('/noticia/{noticia}','PresentacionController@mostrarNoticia');
Route::post('/recuperarClave','PresentacionController@clave');
Route::get('/recuperarContrasena','PresentacionController@recuperarClave');
Route::post('/contacto','PresentacionController@contactanos');

/* ACCESO INTERNO */
Route::get('/login', 'LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

Route::get('cliente/login', 'LoginController@loginUsuario');
Route::post('cliente/login', 'LoginController@loginClientes');
Route::get('/logoutUsuario', 'LoginController@logoutUsuario');

/* PERFIL PARTICULAR INTERNO */
Route::get('/dashboard', 'PresentacionController@dashboard');
Route::get('/intranet/clientes', 'PresentacionController@intranet');
Route::resource('particular', 'ParticularController', ['except' => ['create','show','destroy']]);

/* PERFIL EMPRESA INTERNO */
Route::resource('empresa', 'EmpresaController', ['except'=>['index','create','show','edit','update','destroy']]);

/*
|--------------------------------------------------------------------------
| Web Routes / BACK-END
|--------------------------------------------------------------------------
|
*/

/* ADMINISTRADOR */
Route::resource('empleados', 'EmpleadoController');
Route::resource('roles', 'RolController', ['except'=>['create','show']]);
Route::resource('noticias', 'NoticiaController', ['except' => ['destroy']]);

/* RECEPCION DE MUESTRAS => CLIENTE */
Route::get('muestras', 'RecepcionMuestraController@index')->name('muestras.index');
Route::get('muestras/buscar','RecepcionMuestraController@buscarMuestra')->name('muestras.search');
Route::get('muestras/create', 'RecepcionMuestraController@create')->name('muestras.create');
Route::post('muestras','RecepcionMuestraController@store')->name('muestras.store');
Route::get('muestras/{muestras}', 'RecepcionMuestraController@show');
Route::get('resultadosCliente/{id}','RecepcionMuestraController@cargarDatos');

/* RECEPCION DE MUESTRAS => EMPLEADO = 2 */
Route::resource('recepcion','CatalogoMuestraController', ['except' => ['index','destroy']]);

/* RESULTADO DE MUESTRAS => EMPLEADO = 3 */
Route::resource('analisis', 'AnalisisMuestraController', ['except' => ['index','create','store','show','destroy']]);

/* METODO GENERAL MODIFICAR PERFIL EMPLEADOS*/
Route::resource('perfil', 'PerfilController', ['except' => ['index','show','create','store','destroy']]);
/* METODOS AJAX */
Route::get('buscar/{id}','CatalogoMuestraController@buscarUsuario');