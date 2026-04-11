<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Category;
use Dom\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mostrar los articulos a el admin
        //Auth sirve para traer la info del usuario identificado
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //obtene categorias publicas

        $Cate = Category::select('id', 'mane')
            ->where('status', '1')
            ->get();

        return view('admin.article.create', compact('Cate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        /*
        Formulario: 
        1.titulo = "Articulo-1"
        2.slug= "articulo-1"
        3.Introduccion=Primer articulo del curso
        4.Image = "foto.png"
        5.Body = "Primer articulo del curso"
        6.status = 3
        8.Category_id = 3
        */

        $request->merge([
            'user_id' => Auth::user()->id,
        ]);

        //guarda la solicitud en una variable
        $article = $request->all();

        //se valida si hay un archivo en el request
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('articles', 'public');
            $article['imagen'] = $imagenPath;
        }


        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-create', 'Articulo creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
        $comments = $article->comments()->simplePaginate(5);

        return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        $Cate = Category::select('id', 'mane')
            ->where('status', '1')
            ->get();

        return view('admin.articles.edit', compact('Cate', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //si el usuario actualiza la imagen
        if ($request->hasFile('imagen')) {
            //elliminar imagen anterior
            File::delete(public_path('storage/' . $article->imagen));
            //asigna nueva imagen
            $article['imagen'] = $request->file('imagen')->store('articles');
        }

        //asignar datos
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'introduccion' => $request->introduccion,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->action([ArticleController::class, 'index'])
            ->with('success-update', 'Articulo modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //eliminar imagen del articulo
        if ($article->imagen) {
            File::delete(public_path('storage/' . $article->imagen));
            //eliminar articulo
            $article->delete();

            return redirect()->action([ArticleController::class, 'index'], compact('article'))
                ->with('success-delete', 'Articulo eliminado con exito');
        }
    }
}
