<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\StatsController;

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

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'api' => 'MoneyWise API',
        'version' => '1.0',
        'message' => 'Bienvenue sur l’API MoneyWise 🚀',
        'documentation' => url('/'), // ou lien vers ta page de doc si tu en as une
        'endpoints' => [
            'auth' => [
                'POST /api/register',
                'POST /api/login',
                'POST /api/logout',
                'POST /api/refresh',
                'GET /api/me',
            ],
            'categories' => [
                'GET /api/categories',
                'POST /api/categories',
                'PUT /api/categories/{id}',
                'DELETE /api/categories/{id}',
            ],
            'transactions' => [
                'GET /api/transactions',
                'POST /api/transactions',
                'PUT /api/transactions/{id}',
                'DELETE /api/transactions/{id}',
            ],
            'stats' => [
                'GET /api/stats/categories',
                'GET /api/stats/monthly',
            ],
        ]
    ]);
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Routes protégées par JWT
Route::middleware('auth:api')->group(function () {
    // User info
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    // Categories
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    // Transactions
    Route::get('transactions', [TransactionController::class, 'index']);
    Route::post('transactions', [TransactionController::class, 'store']);
    Route::put('transactions/{transaction}', [TransactionController::class, 'update']);
    Route::delete('transactions/{transaction}', [TransactionController::class, 'destroy']);

    // Stats
    Route::get('stats/categories', [StatsController::class, 'categories']);
    Route::get('stats/monthly', [StatsController::class, 'monthly']);

});
