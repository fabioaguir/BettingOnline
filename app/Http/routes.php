<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');
    });

    Route::group(['prefix' => 'softage', 'middleware' => 'auth', 'as' => 'softage.'], function () {
//    Route::get('login'  , ['as' => 'login', 'uses' => 'SecurityController@login']);
//    Route::get('logout'  , ['as' => 'logout', 'uses' => 'SecurityController@logout']);
//    Route::post('check'  , ['as' => 'check', 'uses' => 'SecurityController@check']);
//    Route::get('index'  , ['as' => 'index', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@index']);
//    Route::get('update2'  , ['as' => 'update2', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@update2']);

        Route::get('index'  , ['as' => 'index', 'uses' => 'DefaultController@index']);
        

        Route::group(['prefix' => 'guest', 'as' => 'guest.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'GuestController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'GuestController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'GuestController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'GuestController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'GuestController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'GuestController@update']);
        });

        Route::group(['prefix' => 'local', 'as' => 'local.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'LocalController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'LocalController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'LocalController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'LocalController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'LocalController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'LocalController@update']);
        });
        
        Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CompanyController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'CompanyController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CompanyController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CompanyController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CompanyController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CompanyController@update']);
        });
        
        
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'UserController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'UserController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'UserController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
        });
        
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'RoleController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'RoleController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'RoleController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'RoleController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'RoleController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'RoleController@update']);
        });

        Route::group(['prefix' => 'util', 'as' => 'util.'], function () {
            Route::post('search', ['as' => 'search', 'uses' => 'UtilController@search']);
            Route::post('select2', ['as' => 'select2', 'uses' => 'UtilController@queryByselect2']);
        });


//    Route::get('report/contratoAluno/{id}', ['as' => 'report.contratoAluno', 'uses' => 'ReportController@contratoAluno']);
//    Route::get('user/save/', ['as' => 'user.save', 'uses' => 'UserController@save']);
//    Route::Post('user/store/', ['as' => 'user.store', 'uses' => 'UserController@store']);
//    Route::Post('user/update/', ['as' => 'user.update', 'uses' => 'UserController@update']);
//    Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
//    Route::get('user/grid', ['as' => 'user.grid', 'uses' => 'UserController@grid']);
    });
});