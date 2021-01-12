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

//Route::prefix('section')->group(function() {
//    Route::get('/', 'SectionController@index');
//});

  Route::group(['middleware' => ['role:admin', 'auth']], function () {    // Admin
//Переключение языков admin
    Route::get('locale/{locale}', '\App\Http\Controllers\Admin\LocaleController@changeLocale')->name('locale');
    Route::middleware(['set_locale'])->group(function () {
      Route::prefix('admin')->group(function () {
        Route::resource('sections', 'AdminSectionController')
          ->names('admin.sections');
        Route::resource('section_items', 'AdminSectionItemController')
          ->except('show', 'index')
          ->names('admin.section_items');
      });
    });

  });
