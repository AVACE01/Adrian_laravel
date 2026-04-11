<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        #obtener los articulo publicos
        $articles = Article::where('status', '1')  #obtener los articulo con estado 1 "true"
            ->orderBy('id', 'desc') #ordenar en desendente por id
            ->simplePaginate(10); #y solo muestra 10 en la pagina principal

        #obtenemos las categorias con estado publico (1) y descartadas (1)
        $Cate = Category::where([
            #aqui ponemos varias condiciones
            ['status', '1'], #que sea publico
            ['is_featured', '1'] #que sea destacado
        ])->paginate(3); #solo muestra 3 paginas

        // se muestra como se manda a traer lo anterior las consulta hay 2 maneras
        //.1 return view('home')->with('articles',$articles);
        //.2
        return view('home.index', compact('articles', 'Cate'));
    }

    //Todas las categorias
    public function all()
    {
        $Cate = Category::where('status', '1')
            ->simplePaginate(20); #y solo muestra 10 en la pagina principal

        $navbar = Category::where([
            #aqui ponemos varias condiciones
            ['status', '1'], #que sea publico
            ['is_featured', '1'] #que sea destacado
        ])->paginate(3); #solo muestra 3 paginas

        return view('home.all-categories', compact('Cate', 'navbar'));
    }
}
