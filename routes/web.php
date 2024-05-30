<?php

use App\Livewire\HomePage;
use App\Livewire\Test;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('public');
// });
Route::get('/', HomePage::class)->name('home');
Route::get('/test', Test::class)->name('test');
