<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::get('/users', [ApiController::class, 'index']);

Route::get('/blogs', [ApiController::class, 'indexBlogs']);
