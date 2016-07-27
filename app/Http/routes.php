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

        //Rotas para Dashboard
        Route::post('dashboard'  , ['as' => 'dashboard', 'uses' => 'DefaultController@dashboard']);
        Route::post('resultVendas'  , ['as' => 'resultVendas', 'uses' => 'DefaultController@resultadosVendas']);

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
            Route::post('grid', ['as' => 'grid', 'uses' => 'AreasController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'AreasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'AreasController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AreasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'AreasController@update']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'AreasController@delete']);
        });

        Route::group(['prefix' => 'vendedor', 'as' => 'vendedor.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'VendedorController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'VendedorController@grid']);
            Route::post('gridConfig/{id}', ['as' => 'gridConfig', 'uses' => 'VendedorController@gridConfig']);
            Route::get('create', ['as' => 'create', 'uses' => 'VendedorController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'VendedorController@store']);
            Route::post('storeConfig', ['as' => 'storeConfig', 'uses' => 'VendedorController@storeConfig']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'VendedorController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'VendedorController@update']);
            Route::post('updateConfig', ['as' => 'updateConfig', 'uses' => 'VendedorController@updateConfig']);
            Route::get('zerar/{id}', ['as' => 'zerar', 'uses' => 'VendedorController@zerar']);
        });

        Route::group(['prefix' => 'arrecadador', 'as' => 'arrecadador.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ArrecadadorController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ArrecadadorController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ArrecadadorController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ArrecadadorController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ArrecadadorController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ArrecadadorController@update']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'ArrecadadorController@delete']);
        });

        # Rota para as partidas
        Route::group(['prefix' => 'partidas', 'as' => 'partidas.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'PartidasController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'PartidasController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'PartidasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'PartidasController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'PartidasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'PartidasController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'PartidasController@destroy']);
            Route::get('getPartidas', ['as' => 'getPartidas', 'uses' => 'PartidasController@getPartidas']);
        });

        # Rota para as modalidades
        Route::group(['prefix' => 'modalidades', 'as' => 'modalidades.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ModalidadesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ModalidadesController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ModalidadesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ModalidadesController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ModalidadesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ModalidadesController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'ModalidadesController@destroy']);
        });

        # Rota para as cotações
        Route::group(['prefix' => 'cotacoes', 'as' => 'cotacoes.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CotacoesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'CotacoesController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CotacoesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CotacoesController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CotacoesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CotacoesController@update']);
            Route::get('destroy/{id}', ['as' => 'edit', 'uses' => 'CotacoesController@destroy']);
        });

        # Rota para gols
        Route::group(['prefix' => 'gols', 'as' => 'gols.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'GolsController@index']);
            Route::post('grid/{idPartida}', ['as' => 'grid', 'uses' => 'GolsController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'GolsController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'GolsController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'GolsController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'GolsController@update']);
            Route::delete('delete/{id}', ['as' => 'delete', 'uses' => 'GolsController@destroy']);
            Route::get('getTimes', ['as' => 'getTimes', 'uses' => 'GolsController@getTimes']);
            Route::get('getResultado/{idPartida}', ['as' => 'getResultado', 'uses' => 'GolsController@getResultado']);
            Route::put('conclude/{idPartida}', ['as' => 'conclude', 'uses' => 'GolsController@conclude']);
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

        Route::group(['prefix' => 'timesAlta', 'as' => 'timesAlta.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'TimesAltaController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'TimesAltaController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'TimesAltaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TimesAltaController@store']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TimesAltaController@delete']);
        });

        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::get('reportPartidasView', ['as' => 'reportPartidasView', 'uses' => 'ReportPartidasController@reportPartidasView']);
            Route::get('getReportPartidas', ['as' => 'getReportPartidas', 'uses' => 'ReportPartidasController@getReportPartidas']);
            Route::get('getPartidasReport', ['as' => 'getPartidasReport', 'uses' => 'CotacoesController@getPartidas']);
            Route::get('reportVendasView', ['as' => 'reportVendasView', 'uses' => 'ReportVendasController@reportVendasView']);
            Route::post('reportVendasSearch', ['as' => 'reportVendasSearch', 'uses' => 'ReportVendasController@reportVendasSearch']);
            Route::post('reportVendasSum', ['as' => 'reportVendasSum', 'uses' => 'ReportVendasController@querySum']);
            Route::get('cupomVendas/{d}', ['as' => 'cupomVendas', 'uses' => 'ReportVendasController@cupomVendas']);
            Route::get('reportApostasView', ['as' => 'reportApostasView', 'uses' => 'ReportApostasController@reportApostasView']);
            Route::post('reportApostasSearch', ['as' => 'reportApostasSearch', 'uses' => 'ReportApostasController@reportApostasSearch']);
            Route::get('reportArrecadacoesView', ['as' => 'reportArrecadacoesView', 'uses' => 'ReportArrecadacoesController@reportArrecadacoesView']);
            Route::post('reportArrecadacoesSearch', ['as' => 'reportArrecadacoesSearch', 'uses' => 'ReportArrecadacoesController@reportArrecadacoesSearch']);
            Route::post('reportArrecadacoesSum', ['as' => 'reportArrecadacoesSum', 'uses' => 'ReportArrecadacoesController@querySum']);
        });
        
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'UserController@grid']);
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