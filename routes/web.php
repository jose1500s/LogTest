<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');