<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User
Route::get('/perfil', 'UserController@index')->name('Perfil');  // pagina do perfil
Route::get('/perfil/editar/{user}', 'UserController@edit')->name('Editar dados');  // pagina de Editar os dados do usuario
Route::put('/perfil/edit/{user}', 'UserController@update')->name('edit.user');  // link que atualiza os dados do usuario
Route::put('/perfil/edit/senha/{user}', 'UserController@updateSenha')->name('senha.user');  // link que atualiza a senha
Route::delete('/perfil/destroy/{user}', 'UserController@destroy')->name('destroy.user');  // link que exclui a conta
Route::get('/usuario/{user}-{name}', 'UserController@show')->name('Usuario');  // pagina do usuario

//Receita
Route::get('/receita/cadastro', 'ReceitaController@create')->name('Cadastro de receita');  // pagina do cadastro da receita
Route::post('/receita/cadastro.do', 'ReceitaController@store')->name('Cadastro de receita.do');  // recebe os dados do formulario e os trata
Route::get('/receita/editar/{receita}', 'ReceitaController@edit')->name('Editar receita');  // pagina de Editar os dados da receita
Route::put('/receita/edit/{receita}', 'ReceitaController@update')->name('Editar receita.do');  // link que atualiza os dados da receita
Route::delete('/receita/destroy/{receita}', 'ReceitaController@destroy')->name('destroy.receita');  // link que exclui a conta
Route::get('/receita/{receita}-{slug}', 'ReceitaController@show')->name('Receita');  // pagina da Receita

//Pesquisa
Route::get('/pesquisar', 'PesquisaController@index')->name('Pesquisar');  // pagina de pesquisar
Route::post('/pesquisa', 'PesquisaController@pesquisar')->name('pesquisa.do');  // faz a pesquisa
Route::post('/pesquisa', 'PesquisaController@pesquisar')->name('Pesquisa'); // pagina com a pesquisar

//Colega
Route::post('/amizade/nova-amizade', 'ColegaController@store')->name('newAmizade');  //link que faz a amizade
Route::delete('/amizade/{colega}', 'ColegaController@destroy')->name('destroy.colega'); // link que exclui a amizade

//Comentario
Route::post('/comentario/novo-comentario', 'ComentarioController@store')->name('newComentario');  //link que salva o comentario
Route::delete('/comentario/{comentario}', 'ComentarioController@destroy')->name('destroy.comentario'); // link que exclui o comentario
Route::put('/comentario/edit/{comentario}', 'ComentarioController@update')->name('Editar comentario.do');  // link que atualiza os dados do comentario

//Avaliação
Route::post('/avaliacao/nova-avaliacao', 'AvaliacaoController@store')->name('newAvaliacao');  //link que salva a avaliação
Route::put('/avaliacao/edit/{avaliacao}', 'AvaliacaoController@update')->name('Editar avaliacao.do'); // link que atualiza os dados da avaliação

//Saves
Route::post('/save/nova-save', 'SaveController@store')->name('newSave');  //link que salva uma save
Route::delete('/save/{save}', 'SaveController@destroy')->name('destroy.save'); // link que exclui uma save

//Idid
Route::get('/receita/cadastro-idid/{receita}', 'ReceitaController@createIdid')->name('Cadastro idid');  // pagina do cadastro IDID