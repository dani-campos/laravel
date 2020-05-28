<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/livros', 'LivrosController@index')
        ->name('listar_livros');
Route::get('/livros/criar', 'LivrosController@create')
        ->name('criar_livro')
        ->middleware('autenticador');
Route::post('/livros/criar', 'LivrosController@store')
        ->middleware('autenticador');
Route::delete('/livros/{id}', 'LivrosController@destroy')
        ->middleware('autenticador');
Route::post('/livros/{id}/editaNome', 'LivrosController@editaNome')
        ->middleware('autenticador');

Route::get('/livros/{livroId}/capitulos', 'CapitulosController@index')
        ->name('listar_capitulos');

Route::get('/capitulos/{capitulo}/paginas', 'PaginasController@index')
        ->name('listar_paginas');

Route::post('/capitulos/{capitulo}/paginas/ler', 'PaginasController@ler')
        ->middleware('autenticador');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});
