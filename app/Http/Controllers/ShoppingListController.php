<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Models\Category;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingLists = ShoppingList::where('user_id', auth()->id())
                                   ->with('category')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        
        return view('app.shopping-lists.index', compact('shoppingLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('app.shopping-lists.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable|string|max:7'
        ]);

        ShoppingList::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'color' => $request->color ?? '#007bff',
            'active' => true
        ]);

        return redirect()->route('shopping-lists.index')
                        ->with('success', 'Lista de compras criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingList $shoppingList)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $shoppingList->load(['category', 'products']);
        
        // Buscar produtos do usuário que não estão na lista
        $availableProducts = \App\Models\Product::where('user_id', auth()->id())
                                               ->whereNotIn('id', $shoppingList->products->pluck('id'))
                                               ->orderBy('name')
                                               ->get();
        
        return view('app.shopping-lists.show', compact('shoppingList', 'availableProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingList $shoppingList)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $categories = Category::where('user_id', auth()->id())->get();
        
        return view('app.shopping-lists.edit', compact('shoppingList', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingList $shoppingList)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable|string|max:7'
        ]);

        $shoppingList->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'color' => $request->color ?? '#007bff'
        ]);

        return redirect()->route('shopping-lists.index')
                        ->with('success', 'Lista de compras atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingList $shoppingList)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $shoppingList->delete();

        return redirect()->route('shopping-lists.index')
                        ->with('success', 'Lista de compras excluída com sucesso!');
    }

    /**
     * Add a product to the shopping list.
     */
    public function addProduct(Request $request, ShoppingList $shoppingList)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // Verificar se o produto pertence ao usuário
        $product = \App\Models\Product::where('id', $request->product_id)
                                     ->where('user_id', auth()->id())
                                     ->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Produto não encontrado ou não pertence a você.');
        }

        // Verificar se o produto já está na lista
        if ($shoppingList->products()->where('product_id', $request->product_id)->exists()) {
            return redirect()->back()->with('error', 'Este produto já está na lista.');
        }

        // Adicionar produto à lista
        $shoppingList->products()->attach($request->product_id);

        return redirect()->back()->with('success', 'Produto adicionado à lista com sucesso!');
    }

    /**
     * Remove a product from the shopping list.
     */
    public function removeProduct(ShoppingList $shoppingList, \App\Models\Product $product)
    {
        // Verificar se a lista pertence ao usuário logado
        if ($shoppingList->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }

        // Verificar se o produto pertence ao usuário
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }

        // Remover produto da lista
        $shoppingList->products()->detach($product->id);

        return redirect()->back()->with('success', 'Produto removido da lista com sucesso!');
    }
}
