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

Route::group(['middleware' => 'role:web-developer'], function() {
    Route::get('/dashboard', function() {
        return 'Добро пожаловать, Веб-разработчик';
    });
});

// Admin
$groupData = ['namespace'=> 'App\Http\Controllers\Admin','prefix'=> 'admin'];

Route::group($groupData, function (){
    Route::resource('/', 'AdminHomeController')
        ->only('index')
        ->names('admin.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
