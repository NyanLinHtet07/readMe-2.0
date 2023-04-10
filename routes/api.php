<?php

use App\Http\Controllers\API\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/menu', MenuController::class);
Route::apiResource('/books', BookController::class);

// Route::prefix('menu')->group(function () {
//     Route::get('/', 'MenuController@index');
//     Route::post('/', 'MenuController@store');
//     Route::put('/update/{id}', 'MenuController@update');
//     Route::delete('/delete/{id}', 'MenuController@destroy');
// });
