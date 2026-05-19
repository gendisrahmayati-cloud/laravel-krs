<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('krs', KrsController::class);
