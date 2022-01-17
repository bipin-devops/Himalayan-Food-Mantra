<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Frontend'], function () {


    //User
    Route::get('/', 'Home\HomeController@index')->name('frontend.index');
    Route::get('/menu', 'MenuController@index');
    Route::get('/gallery', 'GalleryController@index');
    Route::get('/news', 'NewsController@newsList');
    Route::get('/about-us', 'MyAccountController@aboutUs');
    Route::get('/news-detail/{slug}', 'NewsController@newsDetail');
    Route::get('/gallery-detail', 'GalleryController@galleryDetail');
    Route::get('/product-detail/{slug}', 'MenuController@productDetail');
    Route::get('/category/{id}', 'MenuController@categoryProduct');

    // Contact
    Route::get('/contact-us','ContactController@index');
    Route::post('/contact-us','ContactController@postContact');
    Route::get('/forgot-password','MyAccountController@forgotPassword');
    Route::post('/forgot-password','MyAccountController@forgotPasswordSendLink');
    Route::get('/reset-password/{token}','MyAccountController@resetPassword');
    Route::post('/reset-password','MyAccountController@updatePassword');
    Route::get('customer-logout','MyAccountController@logout');



    Route::group(['middleware' => 'auth:customer'], function () {
        Route::get('/profile', 'MyAccountController@myAccount')->name('frontend.user.profile');

        // Cart ROutes
        Route::get('/cart', 'CartController@cart');
        Route::get('/cart', 'Cart\CartController@index');
        Route::delete('/cartproduct', 'Cart\CartController@destroyCartProduct')->name('frontend.cartproduct.destroy');
        Route::delete('/cart', 'Cart\CartController@destroy');
        Route::post('/cart', 'Cart\CartController@storeOrUpdate')->name('frontend.cart');

        // Ajax Cart
        Route::post('/ajax-cart', 'Cart\CartController@ajax')->name('frontend.cart.ajax');
        Route::post('/ajax-cart', 'Cart\CartController@ajax')->name('frontend.cart.ajax');

        // Checkout routes
        Route::get('/checkout', 'CartController@checkout');
        Route::post('/checkout', 'Order\OrderController@store')->name('frontend.order.store');
        Route::get('/checkout/successfull', 'Order\OrderController@success');
    });
});
