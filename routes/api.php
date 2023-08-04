<?php

use App\Http\Controllers\AdminAreasController;
use App\Http\Controllers\AdminAreasPermitidasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LancamentosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\MailController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::get("/",function(){
    echo json_encode([
        'Status' => "active",
        "APP Name" => "API Meu Gestor",
        "Message" => "Seja bem vindo a API, tudo certo por aqui."
    ]);
});

Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => '/lancamentos'], function () {
        Route::get('', [LancamentosController::class, 'index']);
        Route::get('/{id}', [LancamentosController::class, 'show']);
        Route::post('/cadastrar', [LancamentosController::class, 'store']);
        Route::post('/{id}/atualizar', [LancamentosController::class, 'update']);
        Route::delete('/{id}/deletar', [LancamentosController::class, 'destroy']);
    });

    Route::group(['prefix' => '/tipos_lancamentos'], function () {
        Route::get('', [TiposController::class, 'index']);
        Route::get('/{id}', [TiposController::class, 'show']);
        Route::post('/cadastrar', [TiposController::class, 'store']);
        Route::post('/{id}/atualizar', [TiposController::class, 'update']);
        Route::delete('/{id}/deletar', [TiposController::class, 'destroy']);
    });

    Route::group(['prefix' => '/clientes'], function () {
        Route::get('', [ClientesController::class, 'index']);
        Route::get('/{id}', [ClientesController::class, 'show']);
        Route::post('/cadastrar', [ClientesController::class, 'store']);
        Route::post('/{id}/atualizar', [ClientesController::class, 'update']);
        Route::delete('/{id}/deletar', [ClientesController::class, 'destroy']);
    });

    Route::group(['prefix' => '/servicos'], function () {
        Route::get('', [AdminAreasController::class, 'index']);
    });

    Route::group(['prefix' => '/permissoes'], function () {
        Route::get('/{id}', [AdminAreasPermitidasController::class, 'index']);
        Route::get('/{area_id}/{user_id}', [AdminAreasPermitidasController::class, 'has_permission']);
        Route::post('/salvar', [AdminAreasPermitidasController::class, 'salvar']);
    });
});


// Recuperar senha
Route::post('recuperar-senha', [MailController::class, 'index']);
Route::post('valida-codigo-recuperar-senha', [MailController::class, 'validate_code']);
Route::post('atualiza-senha', [MailController::class, 'update_password']);
