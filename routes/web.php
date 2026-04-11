<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//articulos
Route::resource('articles', ArticleController::class)
    ->except('show')
    ->names('articles');
//Categorias
Route::resource('categories', CategoryController::class)
    //con este indicamos que rutas no queremos que se creen
    ->except('show')
    ->names('categories');

//ver articulos 
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');


//ver articulos por categorias
Route::get('categories/{category}', [CategoryController::class, 'detail'])->name('categories.detail');


//Comentarios
Route::resource('comments', CommentController::class)
    //indicamos lo que solo vamos a usar
    ->only('index','destroy')
    ->names('comments');

    
//guardar comentarios
Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');

//perfiles
Route::resource('profiles', ProfileController::class)
    //indicamos lo que solo vamos a usar
    ->only('edit','update')
    ->names('profiles');






    
//Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
//Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
//aqui estamos enviado info de un formulario
//Route::post('/article', [ArticleController::class, 'store'])->name('article.store');

//metodos del articulo
//editar
//Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
//actualizar
//Route::put('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
//liminar 
//Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');
