<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     redirect('tareas');
// });

Route::get('/', 'MainController@index');
Route::resource('tareas', "TareaController");
Route::post('tareas/update', 'TareaController@update')->name('tareas.update');
Route::get('tareas-mostrar', 'TareaController@obtenerTareas')->name('obtener.tareas');
Route::get('tareas/destroy/{id}', 'TareaController@destroy')->name('tareas.destroy');
Route::get('tareas-datatables', 'TareaController@datatables')->name('tareas.datatables');
