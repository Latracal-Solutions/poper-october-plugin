<?php

use Illuminate\Support\Facades\Route;

Route::post('/save-account-id', 'Poper\Poper\Controllers\Settings@onSubmit');
Route::get('/get-account-id', 'Poper\Poper\Controllers\Settings@onGetAccountId');