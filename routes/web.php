<?php

use App\Http\Controllers\EntregasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return view('home', ["title" => "Rastreio de Pacote"]);
});

Route::get('/entregas', [EntregasController::class, 'consulta']);

Route::get('/entrega/{id}', [EntregasController::class, 'entrega']);