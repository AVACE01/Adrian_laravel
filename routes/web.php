<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');
//articulo
Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
//aqui estamos enviado info de un formulario
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

//metodos del articulo
//editar
Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
//actualizar
Route::put('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
//liminar 
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
