<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', ['as' => 'home', 'uses' => 'Admin\Dashboard\DashboardController@index']);

    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('role', 'User\RoleController');
        Route::put('role/update/{id}', 'User\RoleController@update');
        Route::get('role/delete/{id}', 'User\RoleController@destroy');

        Route::get('ajax/chart', 'Dashboard\DashboardController@retrieveChartData')->name('chart.data');

        //User
        Route::get('user', 'User\UserController@index');
        Route::get('user/create', 'User\UserController@create');
        Route::post('user/store', 'User\UserController@store');
        Route::get('user/edit/{id}', 'User\UserController@edit');
        Route::put('user/update/{id}', 'User\UserController@update');
        Route::get('user/delete/{id}', 'User\UserController@delete');

        //Employee
        Route::get('employee', 'Employee\EmployeeController@index');
        Route::get('employee/create', 'Employee\EmployeeController@create');
        Route::post('employee/store', 'Employee\EmployeeController@store');
        Route::get('employee/edit/{id}', 'Employee\EmployeeController@edit');
        Route::put('employee/update/{id}', 'Employee\EmployeeController@update');
        Route::get('employee/delete/{id}', 'Employee\EmployeeController@delete');

        //Category
        Route::get('category', 'Category\CategoryController@index');
        Route::get('category/create', 'Category\CategoryController@create');
        Route::post('category/store', 'Category\CategoryController@store');
        Route::get('category/edit/{id}', 'Category\CategoryController@edit');
        Route::put('category/update/{id}', 'Category\CategoryController@update');
        Route::get('category/delete/{id}', 'Category\CategoryController@delete');

        Route::resource('customer', 'User\CustomerController');
        Route::resource('order', 'Order\OrderController');
        Route::get('order-count', 'Order\OrderController@countOrder')->name('backend.order.count');

        //Product
        Route::get('product', 'Product\ProductController@index');
        Route::get('product/create', 'Product\ProductController@create');
        Route::post('product/store', 'Product\ProductController@store');
        Route::get('product/edit/{id}', 'Product\ProductController@edit');
        Route::put('product/update/{id}', 'Product\ProductController@update');
        Route::get('product/delete/{id}', 'Product\ProductController@delete');

        //Page Management
        Route::get('page', 'Page\PageController@index');
        Route::get('page/create', 'Page\PageController@create');
        Route::post('page/store', 'Page\PageController@store');
        Route::get('page/edit/{id}', 'Page\PageController@edit');
        Route::put('page/update/{id}', 'Page\PageController@update');
        Route::get('page/delete/{id}', 'Page\PageController@delete');

        //News
        Route::get('news', 'News\NewsController@index');
        Route::get('news/create', 'News\NewsController@create');
        Route::post('news/store', 'News\NewsController@store');
        Route::get('news/edit/{id}', 'News\NewsController@edit');
        Route::put('news/update/{id}', 'News\NewsController@update');
        Route::get('news/delete/{id}', 'News\NewsController@delete');

        //Setting
        Route::get('setting', 'Setting\SettingController@index');
        Route::post('setting/store', 'Setting\SettingController@UpdateCreate');

        //contact
        Route::get('contact', 'Contact\ContactController@index');

    });
});
