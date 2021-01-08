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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['role:admin', 'auth']], function() {
    // Admin
    $groupData = ['namespace'=> 'App\Http\Controllers\Admin','prefix'=> 'admin'];

    Route::group($groupData, function (){
        //Переключение языков admin
        Route::get('locale/{locale}', 'LocaleController@changeLocale')->name('locale');
        Route::middleware(['set_locale'])->group(function () {
            Route::get('/', 'AdminHomeController@index')->name('admin.index');
            Route::resource('users', 'UserController')
                ->except('show')
                ->names('admin.users');
            Route::resource('info', 'InfoController')
                ->except('show', 'store', 'destroy')
                ->names('admin.info');
            Route::resource('locales', 'LocaleController')
                ->except('show')
                ->names('admin.locales');


            Route::post('local', 'LocaleController@main_localization')->name('main_localization');
        });

    });
});
