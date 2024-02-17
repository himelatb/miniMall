<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\IndexController;
use App\Models\Category;
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
Route::namespace("App\Http\Controllers\Front")->group(function () {
    Route::get('/miniMall',[IndexController::class, 'index']);

    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');
    //dd($catUrls);
    foreach ($catUrls as $key => $catUrl) {
        Route::get($catUrl, "ProductsController@catListing");
    }
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::middleware(['admin'])->group(function () {
        //dashboard routes
        Route::get('dashboard','AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::match(['get', 'post'],'password.admins', 'AdminController@passwordAdmins');
        
        //admin list routes
        Route::get('view.admins', 'AdminController@viewAdmins');
        Route::post('add.admins', 'AdminController@addAdmins');
        Route::post('update.admins', 'AdminController@updateAdmins');
        Route::post('delete.admins', 'AdminController@deleteAdmins');
        

        //cms pages routes
        Route::get('cms.pages', 'CmsController@index');
        Route::post('add.cms', 'CmsController@store');
        Route::post('update.cms', 'CmsController@update');
        Route::post('delete.cms', 'CmsController@delete');

        //category pages routes
        Route::get('view.category', 'CategoryController@viewCat');
        Route::post('add.category', 'CategoryController@addCat');
        Route::post('update.category', 'CategoryController@updateCat');
        Route::post('delete.category', 'CategoryController@deleteCat');

        //product pages routes
        Route::get('view.product', 'ProductController@view');
        Route::post('add.product', 'ProductController@add');
        Route::post('get.product', 'ProductController@edit');
        Route::post('update.product', 'ProductController@update');
        Route::post('delete.product', 'ProductController@delete');
        Route::post('delete.product.image', 'ProductController@deleteImage');
        Route::post('attribute.status', 'ProductController@changeAttributeStatus');
        Route::post('attribute.delete', 'ProductController@attributeDelete');

        //brand pages routes
        Route::get('view.brand', 'BrandController@view');
        Route::post('add.brand', 'BrandController@add');
        Route::post('get.brand', 'BrandController@edit');
        Route::post('update.brand', 'BrandController@update');
        Route::post('delete.brand', 'BrandController@delete');

        //brand pages routes
        Route::get('view.banner', 'BannerController@view');
        Route::post('add.banner', 'BannerController@add');
        Route::post('get.banner', 'BannerController@edit');
        Route::post('update.banner', 'BannerController@update');
        Route::post('delete.banner', 'BannerController@delete');

    });

});