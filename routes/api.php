<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* Rota responsavel pelos produtos */
Route::get('/produtos', [ProductController::class , 'index']);
Route::post('/produtos', [ProductController::class , 'store']);
Route::get('/produtos/{id}', [ProductController::class , 'show']);
Route::put('/produtos/{id}', [ProductController::class , 'update']);
Route::delete('/produtos/{id}', [ProductController::class , 'destroy']);

/* Rota responsavel pelas categorias */
Route::get('/categorias', [CategoryController::class , 'index']);
Route::post('/categorias', [CategoryController::class , 'store']);
Route::get('/categorias/{id}', [CategoryController::class , 'show']);
Route::put('/categorias/{id}', [CategoryController::class , 'update']);
Route::delete('/categorias/{id}', [CategoryController::class , 'destroy']);


