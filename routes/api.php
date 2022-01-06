<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Backend\ProductController;
use Illuminate\Http\Request;
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

Route::prefix('auth')->group(function () {
    Route::post('/create-account', [AuthenticationController::class, 'createAccount']);
    //login user
    Route::post('/signin', [AuthenticationController::class, 'signin']);
    //using middleware
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/profile', function(Request $request) {
            return auth()->user();
        });
        Route::post('/sign-out', [AuthenticationController::class, 'signout']);
    });
});

Route::prefix('admin')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('store', [ProductController::class, 'store']);
    });
});


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
