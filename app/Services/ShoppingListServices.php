<?php

namespace App\Services;

use App\Models\ShoppingList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ShoppingListServices
{
    public function __construct(public ShoppingList $shoppingList){}
    
    public function index()
    {
        return $this->shoppingList
            ->where('user_id', Auth::id())
            ->with(['category', 'products'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
    
    public function store(array $data): ShoppingList
    {
        $data['user_id'] = Auth::id(); 
        
        $shoppingList = $this->shoppingList->create($data);

        if (isset($data['product_ids']) && is_array($data['product_ids'])) {
            $shoppingList->products()->attach($data['product_ids']);
        }

        return $shoppingList;
    }
    
    public function getById(int $id): ShoppingList
    {
        $shoppingList = $this->shoppingList
            ->where('user_id', Auth::id())
            ->with(['category', 'products'])
            ->find($id);

        if (!$shoppingList) {
            throw new ModelNotFoundException("Lista de Compras com ID {$id} não encontrada ou não pertence ao usuário.");
        }

        return $shoppingList;
    }
    
    public function update(int $id, array $data): ShoppingList
    {
        $shoppingList = $this->getById($id);
        
        if (isset($data['product_ids'])) {
            $shoppingList->products()->sync($data['product_ids']);
            unset($data['product_ids']);
        }

        $shoppingList->update($data);
        return $shoppingList;
    }

    public function delete(int $id): bool
    {
        $shoppingList = $this->getById($id);
        return $shoppingList->delete();
    }
}
