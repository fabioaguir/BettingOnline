<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('aluno.save');
});


Route::group(['prefix' => 'seracademico', 'as' => 'seracademico.'], function () {
    Route::get('login'  , ['as' => 'login', 'uses' => 'SecurityController@login']);
    Route::get('logout'  , ['as' => 'logout', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'SecurityController@logout']);
    Route::post('check'  , ['as' => 'check', 'uses' => 'SecurityController@check']);
    Route::get('index'  , ['as' => 'index', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@index']);
    Route::get('update2'  , ['as' => 'update2', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'DefaultController@update2']);
    Route::get('aluno/save', ['as' => 'alunos.save', 'middleware'=>'security:ROLE_ADMIN','uses' => 'AlunoController@save']);
    Route::get('aluno/grid', ['as' => 'alunos.grid', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'AlunoController@grid']);
    Route::post('aluno/store', ['as' => 'alunos.store', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'AlunoController@store']);
    Route::get('aluno/edit/{id}', ['as' => 'alunos.edit', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'AlunoController@edit']);
    Route::post('aluno/update', ['as' => 'alunos.update', 'middleware'=>'security:ROLE_ADMIN', 'uses' => 'AlunoController@update']);
    Route::get('report/contratoAluno/{id}', ['as' => 'report.contratoAluno', 'uses' => 'ReportController@contratoAluno']);
    Route::get('user/save/', ['as' => 'user.save', 'uses' => 'UserController@save']);
    Route::Post('user/store/', ['as' => 'user.store', 'uses' => 'UserController@store']);
    Route::Post('user/update/', ['as' => 'user.update', 'uses' => 'UserController@update']);
    Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::get('user/grid', ['as' => 'user.grid', 'uses' => 'UserController@grid']);
});
