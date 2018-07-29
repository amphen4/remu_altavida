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

Route::resource('/usuarios','AdminUsersController');
Route::get('/indicadores','AdminIndicadoresController@index')->name('indicadores');
Route::post('/indicadores/data','AdminIndicadoresController@enviarData');
Route::get('/data/eventos','EventsController@data');
Route::post('/data/eventos/save','EventsController@store');
Route::get('/data/graficos/uf','AdminIndicadoresController@graficoUf');
Route::get('/data/graficos/dolar','AdminIndicadoresController@graficoDolar');
Route::get('/data/graficos/utm','AdminIndicadoresController@graficoUtm');
Route::get('/data/graficos/ipc','AdminIndicadoresController@graficoIpc');

Route::get('/empleados','AdminEmpleadosController@index');
Route::get('/data/empleados/lista','AdminEmpleadosController@enviarLista');