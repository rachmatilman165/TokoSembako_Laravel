<?php

use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\UserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('produk', [ProdukController::class, 'index']);
// Route::get('user', [UserApi::class, 'index']);
Route::post('user', [UserApi::class, 'store']);
