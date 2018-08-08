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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

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


Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/usuarios','AdminUsersController');
Route::get('/usuarios','AdminUsersController@index')->name('usuarios.index');
Route::post('/usuarios','AdminUsersController@store')->name('usuarios.store');
Route::get('/usuarios/create','AdminUsersController@create')->name('usuarios.create');
Route::get('/usuarios/{id}/edit','AdminUsersController@edit')->name('usuarios.edit');
Route::put('/usuarios/{id}','AdminUsersController@update')->name('usuarios.update');
Route::delete('/usuarios/eliminar/{id}','AdminUsersController@destroy');
Route::get('/usuarios/data','AdminUsersController@data');

Route::get('/indicadores','AdminIndicadoresController@index')->name('indicadores');
Route::post('/indicadores/data','AdminIndicadoresController@enviarData');
Route::get('/data/eventos','EventsController@data');
Route::post('/data/eventos/save','EventsController@store');
Route::get('/data/graficos/uf','AdminIndicadoresController@graficoUf');
Route::get('/data/graficos/dolar','AdminIndicadoresController@graficoDolar');
Route::get('/data/graficos/utm','AdminIndicadoresController@graficoUtm');
Route::get('/data/graficos/ipc','AdminIndicadoresController@graficoIpc');

Route::get('/empleados','AdminEmpleadosController@index')->name('empleados.index');
Route::get('/data/empleados/lista','AdminEmpleadosController@enviarLista');
Route::post('/empleados/create','AdminEmpleadosController@create');
Route::get('/empleados/fotos/{id}','AdminEmpleadosController@enviarFoto');
Route::get('/data/empleados/{id}','AdminEmpleadosController@enviarDatosEmpleadoJson');

Route::get('/registros_horas','AdminRegistrosController@index')->name('registros.index');
Route::get('/registros_horas/data','AdminRegistrosController@data');
Route::post('/registros_horas','AdminRegistrosController@store');

Route::get('/contratos','AdminContratosController@index');
Route::get('/contratos/crear','AdminContratosController@create');

Route::post('/haberes','AdminHaberesController@store');
Route::get('/haberes/data','AdminHaberesController@data');

Route::post('/descuentos','AdminDescuentosController@store');
Route::get('/descuentos/data','AdminDescuentosController@data');

Route::get('/isapres','AdminIsapresController@index')->name('isapres.index');
Route::post('/isapres','AdminIsapresController@store')->name('isapres.store');
Route::get('/isapres/create','AdminIsapresController@create')->name('isapres.create');
Route::get('/isapres/{id}/edit','AdminIsapresController@edit')->name('isapres.edit');
Route::put('/isapres/{id}','AdminIsapresController@update')->name('isapres.update');
Route::delete('/isapres/eliminar/{id}','AdminIsapresController@destroy');
Route::get('/isapres/data','AdminIsapresController@data');
//Route::get('/isapres/select','AdminIsapresController@select');

Route::get('/afps','AdminAfpsController@index')->name('afps.index');
Route::post('/afps','AdminAfpsController@store')->name('afps.store');
Route::get('/afps/create','AdminAfpsController@create')->name('afps.create');
Route::get('/afps/{id}/edit','AdminAfpsController@edit')->name('afps.edit');
Route::put('/afps/{id}','AdminAfpsController@update')->name('afps.update');
Route::delete('/afps/eliminar/{id}','AdminAfpsController@destroy');
Route::get('/afps/data','AdminAfpsController@data');