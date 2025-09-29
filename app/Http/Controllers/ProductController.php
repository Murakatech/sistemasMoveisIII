<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(public ProductServices $productServices){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productServices->index();
        
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
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $this->productServices->store($data);

        return redirect()->route('products.index')
                        ->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $this->productServices->getById($product->id);
        
        return view('app.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = $this->productServices->getById($product->id);
        
        return view('app.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $this->productServices->update($product->id, $data);

        return redirect()->route('products.index')
                        ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productServices->delete($product->id);

        return redirect()->route('products.index')
                        ->with('success', 'Produto excluído com sucesso!');
    }
}
