<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class CategoryServices
{
    public function __construct(public Category $category){}

    public function index()
    {
        return $this->category
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function store(array $data): Category
    {
        $data['user_id'] = Auth::id();
        return $this->category->create($data);
    }
    
    public function getById(int $id): Category
    {
        $category = $this->category
            ->where('user_id', Auth::id())
            ->find($id);

        if (!$category) {
            throw new ModelNotFoundException("Categoria com ID {$id} não encontrada ou não pertence ao usuário.");
        }

        return $category;
    }

    public function update(int $id, array $data): Category
    {
        $category = $this->getById($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id): bool
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
