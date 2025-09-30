<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class NewProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar usuário Caio
        $caio = User::where('email', 'caio@gmail.com')->first();
        
        if (!$caio) {
            echo "Usuário Caio não encontrado!\n";
            return;
        }

        // 15 produtos com imagens reais das pastas disponíveis
        $products = [
            // Churrasco
            ['name' => 'Picanha Premium', 'image' => 'images/products/Churrasco/lucktz (1).jpg'],
            ['name' => 'Costela Bovina', 'image' => 'images/products/Churrasco/lucktz (5).jpg'],
            ['name' => 'Linguiça Artesanal', 'image' => 'images/products/Churrasco/lucktz (10).jpg'],
            ['name' => 'Fraldinha Temperada', 'image' => 'images/products/Churrasco/lucktz (15).jpg'],
            
            // Comida Fresca
            ['name' => 'Salada Caesar', 'image' => 'images/products/Comida fresca/lucktz (1).JPG'],
            ['name' => 'Salmão Grelhado', 'image' => 'images/products/Comida fresca/lucktz (10).JPG'],
            ['name' => 'Risotto de Camarão', 'image' => 'images/products/Comida fresca/lucktz (20).JPG'],
            ['name' => 'Pasta Italiana', 'image' => 'images/products/Comida fresca/lucktz (30).JPG'],
            ['name' => 'Sushi Variado', 'image' => 'images/products/Comida fresca/lucktz (40).JPG'],
            
            // Fast Food
            ['name' => 'Burger Artesanal', 'image' => 'images/products/Fast Food/lucktz (1).JPG'],
            ['name' => 'Pizza Margherita', 'image' => 'images/products/Fast Food/lucktz (10).JPG'],
            ['name' => 'Hot Dog Gourmet', 'image' => 'images/products/Fast Food/lucktz (20).JPG'],
            ['name' => 'Batata Frita Premium', 'image' => 'images/products/Fast Food/lucktz (30).JPG'],
            
            // Frutas e Legumes
            ['name' => 'Mix de Frutas Tropicais', 'image' => 'images/products/Frutas e Legumes/lucktz (1).JPG'],
            ['name' => 'Salada de Legumes Frescos', 'image' => 'images/products/Frutas e Legumes/lucktz (5).JPG'],
        ];

        echo "Criando 15 novos produtos...\n";

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'image' => $productData['image'],
                'user_id' => $caio->id,
            ]);
        }

        echo "15 produtos criados com sucesso!\n";
        echo "Produtos criados para o usuário: {$caio->name}\n";
    }
}