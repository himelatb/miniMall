<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard','AdminController@dashboard');
        Route::get('view.admins', 'AdminController@viewAdmins');
        Route::post('add.admins', 'AdminController@addAdmins');
        Route::post('update.admins', 'AdminController@updateAdmins');
        Route::post('delete.admins', 'AdminController@deleteAdmins');
        //Route::get('pagination', 'AdminController@pagination');
        //Route::get('search', 'AdminController@search');
        Route::get('logout', 'AdminController@logout');
        Route::match(['get', 'post'],'password.admins', 'AdminController@passwordAdmins');

        //cms pages route
        Route::get('cms.pages', 'CmsController@index');
        Route::post('add.cms', 'CmsController@store');
        Route::post('update.cms', 'CmsController@update');
        Route::post('delete.cms', 'CmsController@delete');

    });

});