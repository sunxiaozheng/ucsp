<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/**
 * Frontend Route
 */
Route::namespace('Home')->group(function () {
    Route::get('/', 'IndexController@index');
});

/**
 * Backend Route
 */
Route::namespace('Admin')->group(function () {
    Route::get('/admin', 'IndexController@index');

    Route::any('/admin/login', 'IndexController@login');

    Route::get('/admin/logout', 'IndexController@logout');
});
