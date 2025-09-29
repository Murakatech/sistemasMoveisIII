<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductWithImagesSeeder extends Seeder
{
    public function run()
    {
        // Buscar categorias e usuário
        $categories = Category::all();
        $user = User::first(); // Usar o primeiro usuário disponível

        // Produtos com imagens das suas pastas
        $products = [
            [
                'name' => 'Hambúrguer Artesanal',
                'image' => 'images/products/Fast Food/lucktz (1).JPG',
                'category' => 'Fast Food'
            ],
            [
                'name' => 'Pizza Margherita',
                'image' => 'images/products/Fast Food/lucktz (5).JPG',
                'category' => 'Fast Food'
            ],
            [
                'name' => 'Batata Frita Especial',
                'image' => 'images/products/Fast Food/lucktz (10).JPG',
                'category' => 'Fast Food'
            ],
            [
                'name' => 'Picanha Grelhada',
                'image' => 'images/products/Churrasco/lucktz (1).jpg',
                'category' => 'Carnes'
            ],
            [
                'name' => 'Costela Assada',
                'image' => 'images/products/Churrasco/lucktz (5).jpg',
                'category' => 'Carnes'
            ],
            [
                'name' => 'Linguiça Artesanal',
                'image' => 'images/products/Churrasco/lucktz (10).jpg',
                'category' => 'Carnes'
            ],
            [
                'name' => 'Salada Fresh',
                'image' => 'images/products/Comida fresca/lucktz (1).JPG',
                'category' => 'Saudável'
            ],
            [
                'name' => 'Prato Vegetariano',
                'image' => 'images/products/Comida fresca/lucktz (15).JPG',
                'category' => 'Saudável'
            ],
            [
                'name' => 'Bowl de Frutas',
                'image' => 'images/products/Comida fresca/lucktz (30).JPG',
                'category' => 'Saudável'
            ],
            [
                'name' => 'Refeição Completa',
                'image' => 'images/products/Comida fresca/lucktz (50).JPG',
                'category' => 'Refeições'
            ]
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'image' => $productData['image'],
                'user_id' => $user->id
            ]);
        }

        $this->command->info('10 produtos criados com sucesso usando suas imagens!');
    }
}