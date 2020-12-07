<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group( function() {
    // Categories Routes
    Route::resource('categories', 'CategoryController'); // resource
    
    // Posts routes
    Route::resource('posts', 'PostController'); // resource
    Route::get('trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('restore-post/{post}', 'PostController@restore')->name('restore-post');

    // Tags Routes
    Route::resource('tags', 'TagController');

});

