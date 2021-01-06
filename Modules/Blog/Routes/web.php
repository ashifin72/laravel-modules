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

//Route::prefix('blog')->group(function() {
//    Route::get('/', 'BlogController@index');
//});

Route::group(['middleware' => ['role:admin', 'auth']], function() {    // Admin
//Переключение языков admin
    Route::get('locale/{locale}', '\App\Http\Controllers\Admin\LocaleController@changeLocale')->name('locale');
    Route::middleware(['set_locale'])->group(function () {
        Route::prefix('admin')->group(function (){
            Route::resource('categories', 'AdminCategoriesController')
                ->except('show')
                ->names('admin.categories');
            Route::resource('posts', 'AdminPostsController')
                ->except('show')
                ->names('admin.posts');
            Route::resource('tags', 'AdminTagsController')
                ->except('show')
                ->names('admin.tags');
            Route::resource('comments', 'AdminCommentsController')
                ->except('show')
                ->names('admin.comments');
        });
    });

});
