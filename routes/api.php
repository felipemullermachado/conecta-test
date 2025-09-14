<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotas públicas de autenticação JWT
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Rotas protegidas por autenticação JWT
Route::middleware('auth:api')->group(function () {
    // Rotas de autenticação para usuários logados
    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    
    // Rota para obter informações do usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Rotas para gerenciamento de usuários (protegidas)
    Route::apiResource('users', UserController::class);
});

// Rota raiz da API com informações básicas (pública)
Route::get('/', function () {
    return response()->json([
        'message' => 'API de Gerenciamento de Usuarios',
        'version' => '1.0.0',
        'authentication' => 'Bearer Token (JWT)',
        'endpoints' => [
            'public' => [
                'POST /api/auth/register' => 'Registrar novo usuario',
                'POST /api/auth/login' => 'Fazer login'
            ],
            'protected' => [
                'GET /api/auth/me' => 'Obter dados do usuario logado',
                'POST /api/auth/logout' => 'Fazer logout',
                'POST /api/auth/refresh' => 'Renovar token JWT',
                'GET /api/users' => 'Listar todos os usuarios',
                'POST /api/users' => 'Criar novo usuario',
                'GET /api/users/{id}' => 'Buscar usuario por ID',
                'PUT /api/users/{id}' => 'Atualizar usuario',
                'DELETE /api/users/{id}' => 'Deletar usuario'
            ]
        ],
        'documentation' => url('/')
    ]);
});