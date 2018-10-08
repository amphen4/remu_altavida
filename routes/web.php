<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// RUTA PRINCIPAL ===================================================
Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});
// RUTAS DE AUTENTICACION ===========================================
//Auth::routes();
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

// RUTAS DE USUARIO BASE =============================================
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile');
Route::put('/profile/update', 'HomeController@profileUpdate');
// RUTAS DE ADMINISTRACION DE USUARIOS DEL SISTEMA ===================
Route::get('/usuarios','AdminUsersController@index')->name('usuarios.index');
Route::post('/usuarios','AdminUsersController@store')->name('usuarios.store');
Route::get('/usuarios/create','AdminUsersController@create')->name('usuarios.create');
Route::get('/usuarios/{id}/edit','AdminUsersController@edit')->name('usuarios.edit');
Route::put('/usuarios/{id}','AdminUsersController@update')->name('usuarios.update');
Route::delete('/usuarios/eliminar/{id}','AdminUsersController@destroy');
Route::get('/usuarios/data','AdminUsersController@data');
Route::get('/usuarios/fotos/{id}', 'HomeController@enviarFoto');
// RUTAS DE SECCION INDICADORES ECONOMICOS ============================
Route::get('/indicadores','AdminIndicadoresController@index')->name('indicadores');
Route::post('/indicadores/data','AdminIndicadoresController@enviarData');
Route::get('/data/graficos/uf','AdminIndicadoresController@graficoUf');
Route::get('/data/graficos/dolar','AdminIndicadoresController@graficoDolar');
Route::get('/data/graficos/utm','AdminIndicadoresController@graficoUtm');
Route::get('/data/graficos/ipc','AdminIndicadoresController@graficoIpc');
// RUTAS DEL CALENDARIO DE NOTAS ======================================
Route::get('/data/eventos','EventsController@data');
Route::post('/data/eventos/save','EventsController@store');
Route::post('/data/eventos/update/{id}', 'EventsController@actualizar');
Route::post('/data/eventos/delete/{id}', 'EventsController@eliminar');
// RUTAS DE ADMINISTRACION DE EMPLEADOS EN EL SISTEMA =================
Route::get('/empleados','AdminEmpleadosController@index')->name('empleados.index');
Route::get('/data/empleados/lista','AdminEmpleadosController@enviarLista');
Route::post('/empleados/create','AdminEmpleadosController@create');
Route::get('/empleados/fotos/{id}','AdminEmpleadosController@enviarFoto');
Route::get('/data/empleados/{id}','AdminEmpleadosController@enviarDatosEmpleadoJson');
// RUTAS DE ADMINISRACION DE REGISTRO DE HORAS =========================
Route::get('/registros_horas','AdminRegistrosController@index')->name('registros.index');
Route::get('/registros_horas/data','AdminRegistrosController@data');
Route::post('/registros_horas','AdminRegistrosController@store');
Route::get('/data/registrosEmpleado/{id}', 'AdminRegistrosController@enviarDataRegistrosEmpleado');
// ROTAS DE ADMINISTRACION DE CONTRATOS EN EL SISTEMA ==================
Route::get('/contratos','AdminContratosController@index');
Route::get('/contratos/crear','AdminContratosController@create');
Route::post('/contratos','AdminContratosController@store');
Route::get('/contratos/data','AdminContratosController@data');
Route::get('/contratos/data_l','AdminContratosController@data_l');
Route::get('/contratos/{id}','AdminContratosController@show');
// RUTAS DE ADMINISTRACION DE HABERES EN EL SISTEMA ====================
Route::post('/haberes','AdminHaberesController@store');
Route::get('/haberes/data','AdminHaberesController@data');
// RUTAS DE ADMINISTRACION DE DESCUENTOS EN EL SISTEMA =================
Route::post('/descuentos','AdminDescuentosController@store');
Route::get('/descuentos/data','AdminDescuentosController@data');
// RUTAS DE ADMINISTRACION DE ISAPRES DE EMPLEADOS =====================
Route::get('/isapres','AdminIsapresController@index')->name('isapres.index');
Route::post('/isapres','AdminIsapresController@store')->name('isapres.store');
Route::get('/isapres/create','AdminIsapresController@create')->name('isapres.create');
Route::get('/isapres/{id}/edit','AdminIsapresController@edit')->name('isapres.edit');
Route::put('/isapres/{id}','AdminIsapresController@update')->name('isapres.update');
Route::delete('/isapres/eliminar/{id}','AdminIsapresController@destroy');
Route::get('/isapres/data','AdminIsapresController@data');
//Route::get('/isapres/select','AdminIsapresController@select');
// RUTAS DE ADMINISTRACION DE AFPS DE EMPLEADOS =========================
Route::get('/afps','AdminAfpsController@index')->name('afps.index');
Route::post('/afps','AdminAfpsController@store')->name('afps.store');
Route::get('/afps/create','AdminAfpsController@create')->name('afps.create');
Route::get('/afps/{id}/edit','AdminAfpsController@edit')->name('afps.edit');
Route::put('/afps/{id}','AdminAfpsController@update')->name('afps.update');
Route::delete('/afps/eliminar/{id}','AdminAfpsController@destroy');
Route::get('/afps/data','AdminAfpsController@data');
// RUTAS DE ADMINISTRACION DE LIQUIDACIONES EN EL SISTEMA ================
Route::get('/liquidaciones','AdminLiquidacionesController@index');
Route::get('/liquidaciones/data','AdminLiquidacionesController@data');
Route::post('/liquidaciones/data/detalleProxLiquidacion','AdminLiquidacionesController@detalleProxLiquidacion');
Route::post('/liquidaciones/generar', 'AdminLiquidacionesController@generarLiquidacionManual')->name('liquidaciones.generarManual');
Route::post('/liquidaciones/haber_a', 'AdminLiquidacionesController@mensualidadesHaberAgotadas');
Route::post('/liquidaciones/dscto_a', 'AdminLiquidacionesController@mensualidadesDsctoAgotadas');
Route::get('data/liquidacionesEmpleado/{id}', 'AdminLiquidacionesController@enviarDataLiquidacionesEmpleado');