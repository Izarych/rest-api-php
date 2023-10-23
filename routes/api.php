<?php

use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['check_user_id_header'])->group(function () {
    Route::group(['prefix' => '/user', 'as' => 'user.'], function() {
        Route::get('/', [UserController::class, 'getAuthenticatedUserInfo'])->name('user.info');
        Route::patch('/', [UserController::class, 'updateUser'])->name('user.update');
        Route::post('/', [UserController::class, 'register'])->name('user.create')->withoutMiddleware('check_user_id_header');
        Route::delete('/', [UserController::class, 'deleteUser'])->name('user.delete');
    });
});
