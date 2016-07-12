<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');
    });

    Route::group(['prefix' => 'betting', 'middleware' => 'auth', 'as' => 'betting.'], function () {
//    Route::get('login'  , ['as' => 'login', 'uses' => 'SecurityController@login']);
//    Route::get('logout'  , ['as' => 'logout', 'uses' => 'SecurityController@logout']);
//    Route::post('check'  , ['as' => 'check', 'uses' => 'SecurityController@check']);
//    Route::get('index'  , ['as' => 'index', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@index']);
//    Route::get('update2'  , ['as' => 'update2', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@update2']);

        Route::get('index'  , ['as' => 'index', 'uses' => 'DefaultController@index']);

        //Rotas para selectes via ajax
        Route::post('allTipoCotacao'  , ['as' => 'allTipoCotacao', 'uses' => 'DefaultController@allTipoCotacao']);

        Route::group(['prefix' => 'parametro', 'as' => 'parametro.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ParametrosController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ParametrosController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ParametrosController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ParametrosController@store']);
            Route::get('save', ['as' => 'save', 'uses' => 'ParametrosController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ParametrosController@update']);
        });

        Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'AreasController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'AreasController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'AreasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'AreasController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AreasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'AreasController@update']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'AreasController@delete']);
        });

        Route::group(['prefix' => 'vendedor', 'as' => 'vendedor.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'VendedorController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'VendedorController@grid']);
            Route::get('gridConfig/{id}', ['as' => 'gridConfig', 'uses' => 'VendedorController@gridConfig']);
            Route::get('create', ['as' => 'create', 'uses' => 'VendedorController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'VendedorController@store']);
            Route::post('storeConfig', ['as' => 'storeConfig', 'uses' => 'VendedorController@storeConfig']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'VendedorController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'VendedorController@update']);
            Route::post('updateConfig', ['as' => 'updateConfig', 'uses' => 'VendedorController@updateConfig']);
            Route::get('zerar/{id}', ['as' => 'zerar', 'uses' => 'VendedorController@zerar']);
        });

        # Rota para as partidas
        Route::group(['prefix' => 'partidas', 'as' => 'partidas.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'PartidasController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'PartidasController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'PartidasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'PartidasController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'PartidasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'PartidasController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'PartidasController@destroy']);
        });

        # Rota para as modalidades
        Route::group(['prefix' => 'modalidades', 'as' => 'modalidades.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ModalidadesController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ModalidadesController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ModalidadesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ModalidadesController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ModalidadesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ModalidadesController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'ModalidadesController@destroy']);
        });

        # Rota para as cotações
        Route::group(['prefix' => 'cotacoes', 'as' => 'cotacoes.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CotacoesController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'CotacoesController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CotacoesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CotacoesController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CotacoesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CotacoesController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'CotacoesController@destroy']);
        });

        Route::group(['prefix' => 'cotacao', 'as' => 'cotacao.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CotacaoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'CotacaoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CotacaoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CotacaoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CotacaoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CotacaoController@update']);
        });

        Route::group(['prefix' => 'modalidade', 'as' => 'modalidade.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ModalidadeController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ModalidadeController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ModalidadeController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ModalidadeController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ModalidadeController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ModalidadeController@update']);
        });

        Route::group(['prefix' => 'resultado', 'as' => 'resultado.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ResultadoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ResultadoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ResultadoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ResultadoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ResultadoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ResultadoController@update']);
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