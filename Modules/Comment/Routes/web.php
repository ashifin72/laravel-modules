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

Route::group(['middleware' => ['role:admin', 'auth']], function() {    // Admin


    Route::prefix('admin')->group(function (){
        Route::resource('comment', 'AdminCommentsController')
            ->except('show')
            ->names('admin.comments');

    });
});
