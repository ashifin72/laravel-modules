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

//Route::prefix('portfolio')->group(function() {
//    Route::get('/', 'PortfolioController@index');
//});

Route::group(['middleware' => ['role:admin', 'auth']], function() {    // Admin
//Переключение языков admin
    Route::get('locale/{locale}', '\App\Http\Controllers\Admin\LocaleController@changeLocale')->name('locale');
    Route::middleware(['set_locale'])->group(function () {
        Route::prefix('admin')->group(function (){
            Route::resource('portfolios', 'AdminPortfolioController')
                ->except('show')
                ->names('admin.portfolios');
            Route::resource('portfolio-categories', 'AdminPortfolioCategoryController')
                ->except('show')
                ->names('admin.portfolio_categories');
            Route::resource('portfolio-feedback', 'AdminPortfolioFeedbackController')
                ->except('show')
                ->names('admin.portfolio_feedback');
        });
    });

});
