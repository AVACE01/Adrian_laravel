<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //MOstrar categoria en el admin
        $Cate = Category::orderBy('id', 'desc')
            ->simplePaginate(8);

        return view('admin.categories.index', compact('Cate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //redirije al formulario
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        $Cate = $request->all();

        //validamos si hay un archivo 
        if ($request->hasFile('imagen')) {
            $Cate['imagen'] = $request->file('imagen')->store('categories');

            //guardar informacion
            Category::create($Cate);

            return redirect()->action([CategoryController::class, 'index'])
                ->with('success-create', 'Categoria creada con exito');
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //si el usuario sube una imagen 
        if ($request->hasFile('imagen')) {
            //elliminar imagen anterior
            File::delete(public_path('storage/' . $category->imagen));
            //asigna nueva imagen
            $category['imagen'] = $request->file('imagen')->store('categories');
        }
        //actualizar datos
        $category->update([
            'name'        => $request->name,
            'slug'         => $request->slug,
            'imagen'        => $request->imagen,
            'is_featured'  => $request->is_featured,
        ]);

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-update', 'La cattegoria a sido modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //eliminar imagen de categoria

        //eliminar imagen del articulo
        if ($category->imagen) {
            File::delete(public_path('storage/' . $category->imagen));
        }
        //eliminar articulo
        $category->delete();

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
            ->with('success-delete', 'La  categoria a sido eliminado con exito');
    }


    //filtrar  articulos por categoria
    public function detail(Category $category)
    {

        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']

        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        $Cate = Category::where([
            #aqui ponemos varias condiciones
            ['status', '1'], #que sea publico
            ['is_featured', '1'] #que sea destacado
        ])->paginate(3); #solo muestra 3 paginas

        return view('subscriber.categories.detail', compact('articles', 'category', 'Cate'));
    }
}
