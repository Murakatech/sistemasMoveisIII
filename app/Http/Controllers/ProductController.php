<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('user_id', auth()->id())
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        
        return view('app.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'user_id' => auth()->id(),
            'name' => $request->name,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/products'), $imageName);
            $data['image'] = 'storage/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('products.index')
                        ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Verificar se o produto pertence ao usuário logado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        return view('app.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Verificar se o produto pertence ao usuário logado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        return view('app.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Verificar se o produto pertence ao usuário logado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Deletar imagem antiga se existir
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/products'), $imageName);
            $data['image'] = 'storage/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')
                        ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Verificar se o produto pertence ao usuário logado
        if ($product->user_id !== auth()->id()) {
            abort(403, 'Acesso negado.');
        }
        
        // Deletar imagem se existir
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Produto excluído com sucesso!');
    }
}
