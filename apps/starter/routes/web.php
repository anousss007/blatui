<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
