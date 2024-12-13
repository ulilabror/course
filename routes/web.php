<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MateriController;

Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');


Route::get('/', function () {
    return view('welcome');
});
