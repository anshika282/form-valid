<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Formcontroller;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/form-submit', Formcontroller::class . '@store')->name('form.submit');
