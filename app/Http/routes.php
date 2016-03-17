<?php

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');
    });

    Route::group(['prefix' => 'seracademico', 'middleware' => 'auth', 'as' => 'seracademico.'], function () {
//    Route::get('login'  , ['as' => 'login', 'uses' => 'SecurityController@login']);
//    Route::get('logout'  , ['as' => 'logout', 'uses' => 'SecurityController@logout']);
//    Route::post('check'  , ['as' => 'check', 'uses' => 'SecurityController@check']);
//    Route::get('index'  , ['as' => 'index', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@index']);
//    Route::get('update2'  , ['as' => 'update2', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@update2']);
        Route::get('index'  , ['as' => 'index', 'uses' => 'DefaultController@index']);

        Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'AlunoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'AlunoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'AlunoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'AlunoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AlunoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'AlunoController@update']);
            Route::get('contrato/{id}', ['as' => 'contrato', 'uses' => 'AlunoController@contrato']);
        });

        Route::group(['prefix' => 'empresa', 'as' => 'empresa.'], function () {
            Route::get('check', ['as' => 'check', 'uses' => 'EmpresaController@checkRoute']);
            Route::get('create', ['as' => 'create', 'uses' => 'EmpresaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'EmpresaController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'EmpresaController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'EmpresaController@update']);
        });

        Route::group(['prefix' => 'sala', 'as' => 'sala.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'SalaController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'SalaController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'SalaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'SalaController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SalaController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'SalaController@update']);
        });

        Route::group(['prefix' => 'tipoAvaliacao', 'as' => 'tipoAvaliacao.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'TipoAvaliacaoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'TipoAvaliacaoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'TipoAvaliacaoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TipoAvaliacaoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TipoAvaliacaoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'TipoAvaliacaoController@update']);
        });

        Route::group(['prefix' => 'tipoDisciplina', 'as' => 'tipoDisciplina.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'TipoDisciplinaController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'TipoDisciplinaController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'TipoDisciplinaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TipoDisciplinaController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TipoDisciplinaController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'TipoDisciplinaController@update']);
        });

        Route::group(['prefix' => 'tipoCurso', 'as' => 'tipoCurso.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'TipoCursoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'TipoCursoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'TipoCursoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'TipoCursoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TipoCursoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'TipoCursoController@update']);
        });

        Route::group(['prefix' => 'sede', 'as' => 'sede.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'SedeController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'SedeController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'SedeController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'SedeController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SedeController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'SedeController@update']);
        });

        Route::group(['prefix' => 'departamento', 'as' => 'departamento.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'DepartamentoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'DepartamentoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'DepartamentoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'DepartamentoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'DepartamentoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'DepartamentoController@update']);
        });

        Route::group(['prefix' => 'disciplina', 'as' => 'disciplina.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'DisciplinaController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'DisciplinaController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'DisciplinaController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'DisciplinaController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'DisciplinaController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'DisciplinaController@update']);
        });

        Route::group(['prefix' => 'curso', 'as' => 'curso.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'CursoController@index']);
            Route::get('grid', ['as' => 'grid', 'uses' => 'CursoController@grid']);
            Route::get('create', ['as' => 'create', 'uses' => 'CursoController@create']);
            Route::post('store', ['as' => 'store', 'uses' => 'CursoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CursoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'CursoController@update']);
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