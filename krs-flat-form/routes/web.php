<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;

Route::resource('krs', KrsController::class);
Route::get('/', function () {
    return view('welcome');
});
