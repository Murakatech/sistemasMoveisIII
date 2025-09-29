<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductServices
{
    public function __construct(public Product $product){}
    
    public function index()
    {
        return $this->product
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
    
    public function store(array $data): Product
    {
        $data['user_id'] = Auth::id();

        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('products', 'public');
        } else {
            unset($data['image']);
        }
        
        return $this->product->create($data);
    }
    
    public function getById(int $id): Product
    {
        $product = $this->product
            ->where('user_id', Auth::id())
            ->find($id);

        if (!$product) {
            throw new ModelNotFoundException("Produto com ID {$id} não encontrado ou não pertence ao usuário.");
        }

        return $product;
    }
    
    public function update(int $id, array $data): Product
    {
        $product = $this->getById($id);

        if (isset($data['image']) && $data['image']->isValid()) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $data['image']->store('products', 'public');
        } else {
            unset($data['image']);
        }

        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = $this->getById($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }
}
