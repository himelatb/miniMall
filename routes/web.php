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
    Route::get('/shop', "ProductsController@catListing");
    Route::get('/product/{id}', "ProductsController@getProduct");
    Route::post('/get_color_by_size', 'ProductsController@getColorBySize');
    Route::post('/add_to_cart', 'ProductsController@addToCart');
    Route::get('/cart', 'IndexController@showCart');
    Route::post('/update_cart_qty', 'IndexController@updateQty');
    Route::get('/checkout', 'IndexController@checkout');
    Route::post('/delete_cart_item', 'IndexController@deleteCartItem');
    Route::match(['get','post'],'/register','UserController@register');
    Route::match(['get','post'],'user/confirm/{code}','UserController@confirmRegistration');
    route::match(['get','post'],'login','UserController@login')->name('login');
    Route::middleware(['auth'])->group(function () {
        Route::match(['get','post'],'/profile','UserController@profile');
        Route::get('/logout', 'UserController@logout');
        Route::post('/get.country_details','UserController@getCountryDetails');
    });
    Route::match(['get','post'],'/password_forget','UserController@forgetPassword');
    Route::match(['get','post'],'user/password_reset/{token?}','UserController@resetPassword');
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

        //product pages routes
        Route::get('view.customers', 'UsersController@view');
        Route::post('add.customers', 'UsersController@add');
        Route::post('get.customers', 'UsersController@edit');
        Route::post('update.customers', 'UsersController@update');
        Route::post('delete.customers', 'UsersController@delete');
        Route::post('delete.customers.image', 'UsersController@deleteImage');

    });

});