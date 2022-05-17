<?php

Route::get('/', [SiteController::class, 'home']);

Route::post('/', [SiteController::class, 'home']);

Route::get('/register', [SiteController::class, 'register']);

Route::post('/register', [SiteController::class, 'register']);

Route::get('/login', [SiteController::class, 'login']);
Route::get('/login/{id}', [SiteController::class, 'login']);
Route::get('/login/{id:\d+}/{username}', [SiteController::class, 'login']);

Route::post('/login', [SiteController::class, 'login']);

Route::get('/forgot', [SiteController::class, 'forgot']);

Route::post('/forgot', [SiteController::class, 'forgot']);

Route::get('/reset_password', [SiteController::class, 'reset_password']);

Route::post('/reset_password', [SiteController::class, 'reset_password']);

Route::get('/logout', [SiteController::class, 'logout']);

Route::get('/profile', [SiteController::class, 'profile']);

Route::get('/profile/setting/{id:\d+}/{username}', [SiteController::class, 'setting']);
Route::post('/profile/setting/{id:\d+}/{username}', [SiteController::class, 'setting']);

Route::get('/profile/edit/{id:\d+}/{username}', [SiteController::class, 'edit']);
Route::post('/profile/edit/{id:\d+}/{username}', [SiteController::class, 'edit']);

Route::get('/profile/{id:\d+}/{username}', [SiteController::class, 'profile']);

Route::get('/chat', [SiteController::class, 'chat']);

Route::post('/chat', [SiteController::class, 'chat']);
