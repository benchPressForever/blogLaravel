<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');


Route::name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/{id}', [PostController::class, 'show']);
        Route::put('/update/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');
        Route::delete('/delete/{id}', [PostController::class, 'delete'])->middleware('auth:sanctum');
        Route::post('/create', [PostController::class, 'create'])->middleware('auth:sanctum');
        Route::post('/add/like/{id}', [PostController::class, 'addLike']);
        Route::post('/del/like/{id}', [PostController::class, 'delLike']);
    });

Route::name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
    });


