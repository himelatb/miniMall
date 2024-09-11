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
        Route::get($catUrl, "IndexController@catListing");
    }
    Route::get('/shop', "IndexController@catListing");
    Route::get('/search', "IndexController@catListing");
    Route::get('/product/{id}', "ProductsController@getProduct");
    Route::post('/get_color_by_size', 'ProductsController@getColorBySize');
    Route::post('/add_to_cart', 'CartController@addToCart');
    Route::get('/cart', 'CartController@showCart');
    Route::post('/update_cart_qty', 'CartController@updateQty');
    Route::post('/delete_cart_item', 'CartController@deleteCartItem');
    Route::match(['get','post'],'/register','UserController@register');
    Route::match(['get','post'],'user/confirm/{code}','UserController@confirmRegistration');
    Route::match(['get','post'],'login','UserController@login')->name('login');
    Route::post('/add_coupon', 'CartController@addCoupon');

    Route::middleware(['auth'])->group(function () {
        Route::match(['get','post'],'/profile','UserController@profile');
        Route::get('/logout', 'UserController@logout');
        Route::match(['get', 'post'],'/my_addresses','UserController@myAddresses');
        Route::post('/default_address','UserController@defaultAddress');
        Route::get('/my_orders', 'UserController@myOrders');
        Route::post('/get.country_details','UserController@getCountryDetails');
        Route::match(['get', 'post'], '/change_password','UserController@changePassword');
        route::get('/order_detail/{id}','UserController@orderDetail');
        route::post('/cancel_order','UserController@cancelOrder');

        Route::post('/remove_coupon', 'CartController@removeCoupon');
        
        Route::match(['get', 'post'], '/checkout', 'CheckoutController@checkout');
        Route::post('/add_address','CheckoutController@addAddress');
        Route::post('/update_address','CheckoutController@updateAddress');
        Route::post('/get_address','CheckoutController@getAddress');
        Route::post('/delete_address','CheckoutController@deleteAddress');
        Route::get( '/place_order','CheckoutController@placeOrder');

        // sslcommerz routes
        Route::post('/pay', 'SslCommerzPaymentController@index');
        Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

        Route::post('/success', 'SslCommerzPaymentController@success');
        Route::post('/fail', 'SslCommerzPaymentController@fail');
        Route::post('/cancel', 'SslCommerzPaymentController@cancel');

        Route::post('/ipn', 'SslCommerzPaymentController@ipn');
        
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

        //cms routes
        Route::get('cms.pages', 'CmsController@index');
        Route::post('add.cms', 'CmsController@store');
        Route::post('update.cms', 'CmsController@update');
        Route::post('delete.cms', 'CmsController@delete');

        //category routes
        Route::get('view.category', 'CategoryController@viewCat');
        Route::post('add.category', 'CategoryController@addCat');
        Route::post('update.category', 'CategoryController@updateCat');
        Route::post('delete.category', 'CategoryController@deleteCat');

        //product routes
        Route::get('view.product', 'ProductController@view');
        Route::post('add.product', 'ProductController@add');
        Route::post('get.product', 'ProductController@edit');
        Route::post('update.product', 'ProductController@update');
        Route::post('delete.product', 'ProductController@delete');
        Route::post('delete.product.image', 'ProductController@deleteImage');
        Route::post('attribute.status', 'ProductController@changeAttributeStatus');
        Route::post('attribute.delete', 'ProductController@attributeDelete');

        //brand routes
        Route::get('view.brand', 'BrandController@view');
        Route::post('add.brand', 'BrandController@add');
        Route::post('get.brand', 'BrandController@edit');
        Route::post('update.brand', 'BrandController@update');
        Route::post('delete.brand', 'BrandController@delete');

        //brand routes
        Route::get('view.banner', 'BannerController@view');
        Route::post('add.banner', 'BannerController@add');
        Route::post('get.banner', 'BannerController@edit');
        Route::post('update.banner', 'BannerController@update');
        Route::post('delete.banner', 'BannerController@delete');

        //product routes
        Route::get('view.customers', 'UsersController@view');
        Route::post('add.customers', 'UsersController@add');
        Route::post('get.customers', 'UsersController@edit');
        Route::post('update.customers', 'UsersController@update');
        Route::post('delete.customers', 'UsersController@delete');
        Route::post('delete.customers.image', 'UsersController@deleteImage');

        //coupon routes
        Route::get('view.coupon', 'CouponController@view');
        Route::post('add.coupon', 'CouponController@add');
        Route::post('get.coupon', 'CouponController@edit');
        Route::post('update.coupon', 'CouponController@update');
        Route::post('delete.coupon', 'CouponController@delete');

        //order routes
        Route::get('view.order', 'OrderController@view');
        Route::get('order-details/{id}', 'OrderController@details');
        Route::post('delete.order', 'OrderController@delete');
        Route::post('order-details/change.status', 'OrderController@statusUpdate');
        Route::get('order-print/{id}','OrderController@printOrder');
        Route::get('order-pdf/{id}', 'OrderController@orderPdf');

    });

});