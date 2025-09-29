<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(public CategoryServices $categoryServices){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryServices->index();
        return view('app.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryServices->store($data);
        return redirect()->route('categories.create')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Verificar se a categoria pertence ao usuário autenticado
        if ($category->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        return view('app.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Verificar se a categoria pertence ao usuário autenticado
        if ($category->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        return view('app.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // Verificar se a categoria pertence ao usuário autenticado
        if ($category->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $data = $request->validated();
        $this->categoryServices->update($category->id, $data);
        
        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Verificar se a categoria pertence ao usuário autenticado
        if ($category->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $this->categoryServices->delete($category->id);
        
        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
