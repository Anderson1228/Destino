<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersAdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PersonajesHistoricosController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\SimbolosController;
use App\Http\Controllers\SenderismoController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\OtrosController;
use App\Http\Controllers\HamburguesaController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\RegistroController;
use App\Http\Livewire\FormularioRegistro;


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
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//  return view('restaurante.index');
//})->middleware('auth')->name('dashboard');


require __DIR__ . '/auth.php';



Route::group([
    'middleware' => 'auth.user',

], function ($router) {
    Route::get('/index_user', [App\Http\Controllers\UserController::class, 'index']);


    Route::resource('user', UserController::class);
});



//RUTAS ADMIN
Route::group([
    'middleware' => 'auth.admin',

], function ($router) {
    
    Route::get('/dashboard_admin', [App\Http\Controllers\AdminController::class, 'index']);
    Route::resource('general', GeneralController::class);
    Route::resource('cafe', CafeController::class);
    Route::resource('users_admin', UsersAdminController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('personajes', PersonajesHistoricosController::class);
    Route::resource('patrimonio', PatrimonioController::class);
    Route::resource('simbolo', SimbolosController::class);
    Route::resource('historia', HistoriaController::class);
    Route::resource('calendario', CalendarioController::class);
    Route::resource('senderismo', SenderismoController::class);
    Route::resource('/foto', FotoController::class);
    Route::resource('hamburguesas', HamburguesaController::class);
    Route::resource('festival', FestivalController::class);
    Route::resource('registros', RegistroController::class);


    //PARA REGISTRAR UN TIPO DE RESTAURANTE
    // Route::get('/rest/registrar/tipo', [App\Http\Controllers\RestauranteController::class, 'typeRestaurant']);
    //RUTA PARA INSERTAR EL TIPO EN LA API
    Route::resource('restaurante', RestauranteController::class);
    Route::POST('/rest/registrar/nuevo_tipo', [App\Http\Controllers\RestauranteController::class, 'createTypeRestaurante']);
    Route::get('/rest/editar_tipo/{id_tipo_res}', [\App\Http\Controllers\RestauranteController::class, 'editar_tipo']);
    Route::PUT('/rest/actualizar_tipo/{id_tipo_res}', [\App\Http\Controllers\RestauranteController::class, 'actualizar_tipo']);
    Route::delete('/restaurante_tipo/elim/{id_tipo_res}', [App\Http\Controllers\RestauranteController::class, 'eliminar_tipo']);
    //PARA EDITAR UN RESTAURANTE
    Route::get('/rest/edit', [App\Http\Controllers\RestauranteController::class, 'editarRestaurante']);
    //ENVIAR ACTUALIZACION DE DATOS RESTAURANTE
    Route::PUT('/rest/actualizar/{id_res}/{id_ruta}/{id_plato}', [\App\Http\Controllers\RestauranteController::class, 'actualizar']);
    Route::delete('/rest/elim/{id_res}/{id_plato}', [App\Http\Controllers\RestauranteController::class, 'eliminar']);
    
    //PARA REGISTRAR UN TIPO DE Otros
    // Route::get('/otrosservicios/registrar/tipo', [App\Http\Controllers\OtrosController::class, 'typeOtrosservicios']);
    //RUTA PARA INSERTAR EL TIPO EN LA API
    Route::resource('otrosservicios', OtrosController::class);
    Route::POST('/otrosservicios/registrar/nuevo_tipo', [App\Http\Controllers\OtrosController::class, 'createTypeOtros']);
    Route::get('/otrosservicios/editar_tipo/{tiposservicio}', [\App\Http\Controllers\OtrosController::class, 'editar_tipo']);
    Route::PUT('/otrosservicios/actualizar_tipo/{tiposservicio}', [\App\Http\Controllers\OtrosController::class, 'actualizar_tipo']);
    Route::delete('/Otros_tipo/elim/{tiposservicio}', [App\Http\Controllers\OtrosController::class, 'eliminar_tipo']);
    //PARA EDITAR UN Otros
    Route::get('/otrosservicios/edit', [App\Http\Controllers\OtrosController::class, 'editarOtros']);
    //ENVIAR ACTUALIZACION DE DATOS Otros
    Route::PUT('/otrosservicios/actualizar/{id}', [\App\Http\Controllers\OtrosController::class, 'actualizar']);
    Route::delete('/otrosservicios/elim/{id}', [App\Http\Controllers\OtrosController::class, 'eliminar']);
    //CAFE
    Route::PUT('/cafe/actualizar/{id_cafe}/{id_menu}/{id_servicio_adicional}', [\App\Http\Controllers\CafeController::class, 'actualizar']);
    Route::delete('/cafe/eliminar/{id_cafe}/{id_menu}/{id_servicio_adicional}', [App\Http\Controllers\CafeController::class, 'destroy']);
    Route::delete('/cafe/borrar/red/{id}/{id_cafe}', [App\Http\Controllers\CafeController::class, 'eliminarRedSocial']);
    Route::POST('/cafe/actualizar/red/{id}', [App\Http\Controllers\CafeController::class, 'actualizarRedes']);
    Route::POST('/cafe/registrar/red/{id}', [App\Http\Controllers\CafeController::class, 'registrarRed']);
    Route::GET('/cafe/eliminar_red/{id_cafe}', [App\Http\Controllers\CafeController::class, 'elimnarRedView']);
    

   
    
    //PARA VER USUARIOS ADMIN

    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
    Route::PUT('/user/actualizar/{id_res}', [\App\Http\Controllers\UsersAdminController::class, 'actualizar']);
    Route::delete('/user/elim/{id_user}', [App\Http\Controllers\UsersAdminController::class, 'destroy']);
    
     
    Route::post('register', [RegisteredUserController::class, 'store']);

    //personajes
    Route::POST('/personaje/registrar', [App\Http\Controllers\PersonajesHistoricosController::class, 'store']);
    Route::get('/personaje/editar_personaje/{id_personaje}', [\App\Http\Controllers\PersonajesHistoricosController::class, 'edit']);
    Route::PUT('/personaje/actualizar/{id_personaje}', [\App\Http\Controllers\PersonajesHistoricosController::class, 'actualizar']);
    Route::delete('/personaje/elim/{id_personaje}', [App\Http\Controllers\PersonajesHistoricosController::class, 'destroy']);

 //patrimonios
 Route::POST('/patrimonio/registrar', [App\Http\Controllers\PatrimonioController::class, 'store']);
 Route::get('/patrimonio/editar_patrimonio/{id_patrimonio}', [\App\Http\Controllers\PatrimonioController::class, 'edit']);
 Route::PUT('/patrimonio/actualizar/{id_patrimonio}', [\App\Http\Controllers\PatrimonioController::class, 'actualizar']);
 Route::delete('/patrimonio/elim/{id_patrimonio}', [App\Http\Controllers\PatrimonioController::class, 'destroy']);

//Simbolos

 //patrimonios
 
 Route::POST('/simbolo/registrar', [App\Http\Controllers\SimbolosController::class, 'store']);
 Route::get('/simbolo/editar_simbolo/{id_simbolo}', [\App\Http\Controllers\SimbolosController::class, 'edit']);
 Route::PUT('/simbolo/actualizar/{id_simbolo}', [\App\Http\Controllers\SimbolosController::class, 'actualizar']);
 Route::delete('/simbolo/elim/{id_simbolo}', [App\Http\Controllers\SimbolosController::class, 'destroy']);


 //HISTORIA
 Route::POST('/historia/registrar', [App\Http\Controllers\HistoriaController::class, 'store']);
 Route::get('/historia/editar_historia/{id_historia}', [\App\Http\Controllers\HistoriaController::class, 'edit']);
 Route::PUT('/historia/actualizar/{id_historia}', [\App\Http\Controllers\HistoriaController::class, 'actualizar']);
 Route::delete('/historia/elim/{id_historia}', [App\Http\Controllers\HistoriaController::class, 'destroy']);

  //hamburguesas
  Route::POST('/hamburguesas/registrar', [App\Http\Controllers\HamburguesaController::class, 'store']);
  Route::get('/hamburguesas/editar_hamburguesas/{id}', [\App\Http\Controllers\HamburguesaController::class, 'edit']);
  Route::PUT('/hamburguesas/actualizar/{id}', [\App\Http\Controllers\HamburguesaController::class, 'actualizar']);
  Route::delete('/hamburguesas/elim/{id}', [App\Http\Controllers\HamburguesaController::class, 'destroy']);

  //calendario
  Route::POST('/calendario/registrar', [App\Http\Controllers\CalendarioController::class, 'store']);
  Route::get('/calendario/editar_calendario/{id}', [\App\Http\Controllers\CalendarioController::class, 'edit']);
  Route::PUT('/calendario/actualizar/{id}', [\App\Http\Controllers\CalendarioController::class, 'actualizar']);
  Route::delete('/calendario/elim/{id}', [App\Http\Controllers\CalendarioController::class, 'destroy']);

    //HISTORIA
 Route::POST('/senderismo/registrar', [App\Http\Controllers\SenderismoController::class, 'store']);
 Route::get('/senderismo/editar_senderismo/{id_senderismo}', [\App\Http\Controllers\SenderismoController::class, 'edit']);
 Route::PUT('/senderismo/actualizar/{id_senderismo}', [\App\Http\Controllers\SenderismoController::class, 'actualizar']);
 Route::delete('/senderismo/elim/{id_senderismo}', [App\Http\Controllers\SenderismoController::class, 'destroy']);


 Route::get('registros.export', [RegistroController::class, 'export'])->name('registros.export');

});

