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

        //Rotas para sete da sorte
        Route::get('seteSorte'  , ['as' => 'seteSorte', 'uses' => 'SeteSorteController@index']);
        Route::post('seteGrid'  , ['as' => 'seteGrid', 'uses' => 'SeteSorteController@dashboard']);
        Route::post('resultVendasST'  , ['as' => 'resultVendasST', 'uses' => 'SeteSorteController@resultadosVendas']);

        //Rotas para selectes via ajax
        Route::post('allTipoCotacao'  , ['as' => 'allTipoCotacao', 'uses' => 'DefaultController@allTipoCotacao']);

        Route::group(['prefix' => 'parametro', 'as' => 'parametro.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ParametrosController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ParametrosController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ParametrosController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ParametrosController@store']);
            Route::get('save', ['middleware' => 'permission:parametro.update', 'as' => 'save', 'uses' => 'ParametrosController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ParametrosController@update']);
        });

        Route::group(['prefix' => 'area', 'as' => 'area.'], function () {
            Route::get('index', ['middleware' => 'permission:area.select', 'as' => 'index', 'uses' => 'AreasController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'AreasController@grid']);
            Route::get('create', ['middleware' => 'permission:area.create', 'as' => 'create', 'uses' => 'AreasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'AreasController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:area.update', 'as' => 'edit', 'uses' => 'AreasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'AreasController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:area.destroy', 'as' => 'delete', 'uses' => 'AreasController@delete']);
        });

        Route::group(['prefix' => 'vendedor', 'as' => 'vendedor.'], function () {
            Route::get('index', ['middleware' => 'permission:vendedor.select', 'as' => 'index', 'uses' => 'VendedorController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'VendedorController@grid']);
            Route::post('gridConfig/{id}', ['as' => 'gridConfig', 'uses' => 'VendedorController@gridConfig']);
            Route::get('create', ['middleware' => 'permission:vendedor.create', 'as' => 'create', 'uses' => 'VendedorController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'VendedorController@store']);
            Route::post('storeConfig', ['as' => 'storeConfig', 'uses' => 'VendedorController@storeConfig']);
            Route::get('edit/{id}', ['middleware' => 'permission:vendedor.update', 'as' => 'edit', 'uses' => 'VendedorController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'VendedorController@update']);
            Route::post('updateConfig', ['as' => 'updateConfig', 'uses' => 'VendedorController@updateConfig']);
            Route::get('zerar/{id}', ['as' => 'zerar', 'uses' => 'VendedorController@zerar']);
        });

        Route::group(['prefix' => 'arrecadador', 'as' => 'arrecadador.'], function () {
            Route::get('index', ['middleware' => 'permission:arrecadador.select', 'as' => 'index', 'uses' => 'ArrecadadorController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ArrecadadorController@grid']);
            Route::get('create', ['middleware' => 'permission:arrecadador.create', 'as' => 'create', 'uses' => 'ArrecadadorController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ArrecadadorController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:arrecadador.update', 'as' => 'edit', 'uses' => 'ArrecadadorController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ArrecadadorController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:arrecadador.destroy', 'as' => 'delete', 'uses' => 'ArrecadadorController@delete']);
        });

        # Rota para as partidas
        Route::group(['prefix' => 'partidas', 'as' => 'partidas.'], function () {
            Route::get('index', ['middleware' => 'permission:partida.select', 'as' => 'index', 'uses' => 'PartidasController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'PartidasController@grid']);
            Route::get('create', ['middleware' => 'permission:partida.create', 'as' => 'create', 'uses' => 'PartidasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'PartidasController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:partida.update', 'as' => 'edit', 'uses' => 'PartidasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'PartidasController@update']);
            Route::get('destroy/{id}', ['middleware' => 'permission:partida.destroy', 'as' => 'edit', 'uses' => 'PartidasController@destroy']);
            Route::get('getPartidas', ['as' => 'getPartidas', 'uses' => 'PartidasController@getPartidas']);
            Route::get('getPartidasSemApostas', ['as' => 'getPartidasSemApostas', 'uses' => 'PartidasController@getPartidasSemApostas']);
        });

        # Rota para as modalidades
        Route::group(['prefix' => 'modalidades', 'as' => 'modalidades.'], function () {
            Route::get('index', ['middleware' => 'permission:modalidade.select', 'as' => 'index', 'uses' => 'ModalidadesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ModalidadesController@grid']);
            Route::get('create', ['middleware' => 'permission:modalidade.create', 'as' => 'create', 'uses' => 'ModalidadesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ModalidadesController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:modalidade.update', 'as' => 'edit', 'uses' => 'ModalidadesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ModalidadesController@update']);
            Route::get('destroy/{id}', ['middleware' => 'permission:modalidade.destroy', 'as' => 'edit', 'uses' => 'ModalidadesController@destroy']);
            Route::get('getModalidade/{id}', ['as' => 'getModalidade', 'uses' => 'ModalidadesController@getModalidade']);
        });

        # Rota para as cotações
        Route::group(['prefix' => 'cotacoes', 'as' => 'cotacoes.'], function () {
            Route::get('index', ['middleware' => 'permission:cotacao.select', 'as' => 'index', 'uses' => 'CotacoesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'CotacoesController@grid']);
            Route::get('create', ['middleware' => 'permission:cotacao.create', 'as' => 'create', 'uses' => 'CotacoesController@create']);
            Route::get('createMultiplo', ['as' => 'createMultiplo', 'uses' => 'CotacoesController@createMultiplo']);
            Route::post('store', ['as' => 'store', 'uses' => 'CotacoesController@store']);
            Route::post('storeMultiplo', ['as' => 'storeMultiplo', 'uses' => 'CotacoesController@storeMultiplo']);
            Route::get('edit/{id}', ['middleware' => 'permission:cotacao.update', 'as' => 'edit', 'uses' => 'CotacoesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CotacoesController@update']);
            Route::get('destroy/{id}', ['middleware' => 'permission:cotacao.destroy', 'as' => 'edit', 'uses' => 'CotacoesController@destroy']);
        });

        # Rota para gols
        Route::group(['prefix' => 'gols', 'as' => 'gols.'], function () {
            Route::get('index', ['middleware' => 'permission:resultado.select', 'as' => 'index', 'uses' => 'GolsController@index']);
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

        Route::group(['prefix' => 'resultado', 'as' => 'resultado.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ResultadoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'ResultadoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'ResultadoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ResultadoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ResultadoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ResultadoController@update']);
        });

        Route::group(['prefix' => 'timesAlta', 'as' => 'timesAlta.'], function () {
            Route::get('index', ['middleware' => 'permission:times.alta.select', 'as' => 'index', 'uses' => 'TimesAltaController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'TimesAltaController@grid']);
            Route::get('create', ['middleware' => 'permission:times.alta.create', 'as' => 'create', 'uses' => 'TimesAltaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TimesAltaController@store']);
            Route::get('delete/{id}', ['middleware' => 'permission:times.alta.destroy', 'as' => 'delete', 'uses' => 'TimesAltaController@delete']);
        });

        Route::group(['prefix' => 'chipe', 'as' => 'chipe.'], function () {
            Route::get('index', ['middleware' => 'permission:chips.select', 'as' => 'index', 'uses' => 'ChipesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ChipesController@grid']);
            Route::get('create', ['middleware' => 'permission:chips.create', 'as' => 'create', 'uses' => 'ChipesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ChipesController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:chips.update', 'as' => 'edit', 'uses' => 'ChipesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ChipesController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:chips.destroy', 'as' => 'delete', 'uses' => 'ChipesController@delete']);
        });

        Route::group(['prefix' => 'impressora', 'as' => 'impressora.'], function () {
            Route::get('index', ['middleware' => 'permission:impressoras.select', 'as' => 'index', 'uses' => 'ImpressorasController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'ImpressorasController@grid']);
            Route::get('create', ['middleware' => 'permission:impressoras.create', 'as' => 'create', 'uses' => 'ImpressorasController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'ImpressorasController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:impressoras.update', 'as' => 'edit', 'uses' => 'ImpressorasController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ImpressorasController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:impressoras.destroy', 'as' => 'delete', 'uses' => 'ImpressorasController@delete']);
        });

        Route::group(['prefix' => 'tablet', 'as' => 'tablet.'], function () {
            Route::get('index', ['middleware' => 'permission:tablets.select', 'as' => 'index', 'uses' => 'TabletsController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'TabletsController@grid']);
            Route::get('create', ['middleware' => 'permission:tablets.create', 'as' => 'create', 'uses' => 'TabletsController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TabletsController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:tablets.update', 'as' => 'edit', 'uses' => 'TabletsController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'TabletsController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:tablets.destroy', 'as' => 'delete', 'uses' => 'TabletsController@delete']);
        });

        Route::group(['prefix' => 'time', 'as' => 'time.'], function () {
            Route::get('index', ['middleware' => 'permission:times.select', 'as' => 'index', 'uses' => 'TimesController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'TimesController@grid']);
            Route::get('create', ['middleware' => 'permission:times.create', 'as' => 'create', 'uses' => 'TimesController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TimesController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:times.update', 'as' => 'edit', 'uses' => 'TimesController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'TimesController@update']);
            Route::get('delete/{id}', ['middleware' => 'permission:times.destroy', 'as' => 'delete', 'uses' => 'TimesController@delete']);
        });

        Route::group(['prefix' => 'campeonato', 'as' => 'campeonato.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CampeonatosController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'CampeonatosController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CampeonatosController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CampeonatosController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CampeonatosController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CampeonatosController@update']);
            Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'CampeonatosController@delete']);
        });

        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::post('reportFinanceiroSum', ['as' => 'reportFinanceiroSum', 'uses' => 'ReportFinanceiroController@reportFinanceiroSum']);
            Route::get('reportFinanceiroView', ['middleware' => 'permission:report.financeiro', 'as' => 'reportFinanceiroView', 'uses' => 'ReportFinanceiroController@reportFinanceiroView']);
            Route::post('exporteFinanceiro', ['as' => 'exporteFinanceiro', 'uses' => 'ReportFinanceiroController@exporteFinanceiro']);
            Route::get('gridReportFinanceiro', ['as' => 'gridReportFinanceiro', 'uses' => 'ReportFinanceiroController@grid']);
            Route::get('reportPartidasView', ['middleware' => 'permission:report.resultados', 'as' => 'reportPartidasView', 'uses' => 'ReportPartidasController@reportPartidasView']);
            Route::get('getReportPartidas', ['as' => 'getReportPartidas', 'uses' => 'ReportPartidasController@getReportPartidas']);
            Route::get('getPartidasReport', ['as' => 'getPartidasReport', 'uses' => 'CotacoesController@getPartidas']);
            Route::get('reportVendasView', ['middleware' => 'permission:report.vendas', 'as' => 'reportVendasView', 'uses' => 'ReportVendasController@reportVendasView']);
            Route::post('reportVendasSearch', ['as' => 'reportVendasSearch', 'uses' => 'ReportVendasController@reportVendasSearch']);
            Route::post('reportVendasSum', ['as' => 'reportVendasSum', 'uses' => 'ReportVendasController@querySum']);
            Route::post('pdfVendas', ['as' => 'pdfVendas', 'uses' => 'ReportVendasController@pdfVendas']);
            Route::get('cupomVendas/{d}', ['as' => 'cupomVendas', 'uses' => 'ReportVendasController@cupomVendas']);
            Route::get('cancelarVenda/{d}', ['as' => 'cancelarVenda', 'uses' => 'ReportVendasController@cancelarVenda']);
            Route::get('reportApostasView', ['middleware' => 'permission:report.apostas.partidas', 'as' => 'reportApostasView', 'uses' => 'ReportApostasController@reportApostasView']);
            Route::post('reportApostasSearch', ['as' => 'reportApostasSearch', 'uses' => 'ReportApostasController@reportApostasSearch']);
            Route::post('pdfApostas', ['as' => 'pdfApostas', 'uses' => 'ReportApostasController@pdfApostas']);
            Route::get('reportArrecadacoesView', ['middleware' => 'permission:report.arrecadacoes', 'as' => 'reportArrecadacoesView', 'uses' => 'ReportArrecadacoesController@reportArrecadacoesView']);
            Route::post('reportArrecadacoesSearch', ['as' => 'reportArrecadacoesSearch', 'uses' => 'ReportArrecadacoesController@reportArrecadacoesSearch']);
            Route::post('reportArrecadacoesSum', ['as' => 'reportArrecadacoesSum', 'uses' => 'ReportArrecadacoesController@querySum']);
            Route::post('exporteArrecadacoes', ['as' => 'exporteArrecadacoes', 'uses' => 'ReportArrecadacoesController@exporteArrecadacoes']);
            Route::get('reportModalidades', ['middleware' => 'permission:report.modalidades', 'as' => 'reportModalidades', 'uses' => 'ModalidadesController@report']);

            //Report vedas premiadas
            Route::get('reportVendasPremiadasView', ['middleware' => 'permission:report.vendas.premiadas', 'as' => 'reportVendasPremiadasView', 'uses' => 'ReportVendasPremiadasController@view']);
            Route::post('reportVendasPremiadasSearch', ['as' => 'reportVendasPremiadasSearch', 'uses' => 'ReportVendasPremiadasController@search']);
            Route::post('reportVendasPremiadasSum', ['as' => 'reportVendasPremiadasSum', 'uses' => 'ReportVendasPremiadasController@querySum']);
            Route::post('pdfVendasPremiadas', ['as' => 'pdfVendasPremiadas', 'uses' => 'ReportVendasPremiadasController@pdfVendas']);
        });
        
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('index', ['middleware' => 'permission:usuario.select', 'as' => 'index', 'uses' => 'UserController@index']);
            Route::post('grid', ['as' => 'grid', 'uses' => 'UserController@grid']);
            Route::get('create', ['middleware' => 'permission:usuario.create', 'as' => 'create', 'uses' => 'UserController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'UserController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:usuario.update', 'as' => 'edit', 'uses' => 'UserController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
        });
        
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('index', ['middleware' => 'permission:perfil.select', 'as' => 'index', 'uses' => 'RoleController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'RoleController@grid']);
            Route::get('create', ['middleware' => 'permission:perfil.create', 'as' => 'create', 'uses' => 'RoleController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'RoleController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:perfil.update', 'as' => 'edit', 'uses' => 'RoleController@edit']);
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