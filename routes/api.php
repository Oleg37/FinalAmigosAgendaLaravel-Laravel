<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Ruta para la información de las llamadas.
 */

Route::resource("call", CallController::class, ['except' => ['create', 'edit']]);

/**
 * Ruta para la información de nuestro contacto amigo.
 */

Route::resource("friend", FriendController::class, ['except' => ['create', 'edit']]);

/**
 * Ruta para eliminar toda la información de la columna de los mensajes.
 */

Route::delete("destroyAll", [FriendController::class, 'destroyAll'])->name("destroyAll");
