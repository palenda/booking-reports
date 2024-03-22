<?php

use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReportsController::class, 'index']);
