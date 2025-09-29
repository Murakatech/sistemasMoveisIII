<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingListRequest;
use App\Models\ShoppingList;
use App\Models\Category;
use App\Services\ShoppingListServices;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function __construct(public ShoppingListServices $shoppingListServices){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingLists = $this->shoppingListServices->index();
        
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
    public function store(ShoppingListRequest $request)
    {
        $data = $request->validated();
        $data['color'] = $data['color'] ?? '#007bff';
        $data['active'] = true;
        
        $this->shoppingListServices->store($data);

        return redirect()->route('shopping-lists.index')
                        ->with('success', 'Lista de compras criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingList $shoppingList)
    {
        $shoppingList = $this->shoppingListServices->getById($shoppingList->id);
        
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
        $shoppingList = $this->shoppingListServices->getById($shoppingList->id);
        $categories = Category::where('user_id', auth()->id())->get();
        
        return view('app.shopping-lists.edit', compact('shoppingList', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShoppingListRequest $request, ShoppingList $shoppingList)
    {
        $data = $request->validated();
        $data['color'] = $data['color'] ?? '#007bff';
        
        $this->shoppingListServices->update($shoppingList->id, $data);

        return redirect()->route('shopping-lists.index')
                        ->with('success', 'Lista de compras atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingList $shoppingList)
    {
        $this->shoppingListServices->delete($shoppingList->id);

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
