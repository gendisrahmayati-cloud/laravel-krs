<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;

Route::get('/', function () {
    return redirect('/krs');
});

Route::resource('krs', KrsController::class);
