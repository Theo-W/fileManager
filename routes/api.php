<?php

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

Route::get('/folders', ['App\Http\Controllers\FolderController', 'index']);
Route::post('/folders', ['App\Http\Controllers\FolderController', 'store']);
Route::delete('/folders/{folder}', ['App\Http\Controllers\FileController', 'delete'])->where(['folder' => '.*']);

Route::get('/files', ['App\Http\Controllers\FileController', 'index']);
Route::post('/files', ['App\Http\Controllers\FileController', 'store']);
Route::delete('/files/{file}', ['App\Http\Controllers\FileController', 'delete'])->where(['file' => '.*']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
