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

//Route::prefix('article')->group(function() {
//    Route::get('/', 'ArticleController@index');
//});
Route::group(['middleware' => ['role:admin', 'auth']], function() {    // Admin


    Route::prefix('admin')->group(function (){
        Route::resource('category', 'AdminCategoryController')
            ->except('show')
            ->names('admin.categories');
        Route::resource('post', 'AdminPostController')
            ->except('show')
            ->names('admin.posts');
    });
});
