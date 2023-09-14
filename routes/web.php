<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () { return redirect(env('APP_URL') . '/admin');} );
