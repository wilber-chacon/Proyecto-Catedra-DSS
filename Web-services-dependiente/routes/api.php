<?php
// CE211044
use App\Http\Controllers\CuentabancariaController;
use App\Http\Controllers\DependienteController;
use App\Http\Controllers\SesionesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These CE211044
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cuentas/{dui}', [CuentabancariaController::class, 'cuentas']);
Route::post('/retiro', [CuentabancariaController::class, 'retiro']);
Route::post('/ingreso', [CuentabancariaController::class, 'ingreso']);
Route::post('/logueo', [SesionesController::class, 'logueo']);

