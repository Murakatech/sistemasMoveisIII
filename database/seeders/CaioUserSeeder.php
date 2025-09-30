<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Hash;

class CaioUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar usuário Caio existente ou criar se não existir
        $caio = User::where('email', 'caio@gmail.com')->first();
        
        if (!$caio) {
            $caio = User::create([
                'name' => 'Caio Silva',
                'email' => 'caio@gmail.com',
                'password' => Hash::make('123456'),
            ]);
            echo "Usuário Caio criado!\n";
        } else {
            echo "Usuário Caio encontrado: {$caio->name}\n";
        }

        // Criar categorias variadas
        $categories = [
            ['title' => 'Eletrônicos', 'color' => '#3B82F6'],
            ['title' => 'Casa e Jardim', 'color' => '#10B981'],
            ['title' => 'Roupas', 'color' => '#8B5CF6'],
            ['title' => 'Alimentação', 'color' => '#F59E0B'],
            ['title' => 'Livros', 'color' => '#EF4444'],
            ['title' => 'Esportes', 'color' => '#06B6D4'],
            ['title' => 'Beleza', 'color' => '#EC4899'],
            ['title' => 'Automóveis', 'color' => '#6B7280'],
        ];

        $createdCategories = [];
        foreach ($categories as $categoryData) {
            $category = Category::create([
                'title' => $categoryData['title'],
                'color' => $categoryData['color'],
                'user_id' => $caio->id,
            ]);
            $createdCategories[] = $category;
        }

        echo "Categorias criadas!\n";

        // Produtos com imagens variadas
        $products = [
            'iPhone 15 Pro',
            'MacBook Air M2', 
            'AirPods Pro',
            'iPad Pro',
            'Sofá 3 Lugares',
            'Mesa de Jantar',
            'Plantas Decorativas',
            'Luminária LED',
            'Camiseta Premium',
            'Jeans Skinny',
            'Tênis Esportivo',
            'Jaqueta de Couro',
            'Café Gourmet',
            'Chocolate Belga',
            'Vinho Tinto',
            'Azeite Extra Virgem',
            'Clean Code',
            'Design Patterns',
            'Laravel Avançado',
            'Bicicleta Mountain Bike',
            'Kit Academia',
            'Prancha de Surf',
            'Smart TV 55"',
            'Notebook Gamer',
            'Mouse Gamer',
            'Teclado Mecânico',
            'Headset Gamer',
            'Webcam HD',
            'Monitor 4K',
            'SSD 1TB'
        ];

        $createdProducts = [];
        foreach ($products as $productName) {
            $product = Product::create([
                'name' => $productName,
                'image' => 'products/' . strtolower(str_replace(' ', '_', $productName)) . '.jpg',
                'user_id' => $caio->id,
            ]);
            $createdProducts[] = $product;
        }

        echo "Produtos criados!\n";

        // Criar listas de compras variadas
        $shoppingLists = [
            [
                'title' => 'Setup Home Office',
                'color' => '#3B82F6',
                'category' => 'Eletrônicos',
                'products' => ['MacBook Air M2', 'iPad Pro', 'AirPods Pro', 'Monitor 4K']
            ],
            [
                'title' => 'Renovação da Sala',
                'color' => '#10B981',
                'category' => 'Casa e Jardim',
                'products' => ['Sofá 3 Lugares', 'Mesa de Jantar', 'Plantas Decorativas', 'Smart TV 55"']
            ],
            [
                'title' => 'Guarda-roupa Novo',
                'color' => '#8B5CF6',
                'category' => 'Roupas',
                'products' => ['Camiseta Premium', 'Jeans Skinny', 'Tênis Esportivo', 'Jaqueta de Couro']
            ],
            [
                'title' => 'Despensa Gourmet',
                'color' => '#F59E0B',
                'category' => 'Alimentação',
                'products' => ['Café Gourmet', 'Chocolate Belga', 'Vinho Tinto', 'Azeite Extra Virgem']
            ],
            [
                'title' => 'Biblioteca Dev',
                'color' => '#EF4444',
                'category' => 'Livros',
                'products' => ['Clean Code', 'Design Patterns', 'Laravel Avançado']
            ],
            [
                'title' => 'Gaming Setup',
                'color' => '#06B6D4',
                'category' => 'Eletrônicos',
                'products' => ['Notebook Gamer', 'Mouse Gamer', 'Teclado Mecânico', 'Headset Gamer']
            ],
            [
                'title' => 'Tech Essentials',
                'color' => '#6366F1',
                'category' => 'Eletrônicos',
                'products' => ['iPhone 15 Pro', 'AirPods Pro', 'MacBook Air M2', 'SSD 1TB']
            ],
            [
                'title' => 'Vida Ativa',
                'color' => '#10B981',
                'category' => 'Esportes',
                'products' => ['Bicicleta Mountain Bike', 'Kit Academia', 'Prancha de Surf', 'Tênis Esportivo']
            ]
        ];

        foreach ($shoppingLists as $listData) {
            $category = collect($createdCategories)->firstWhere('title', $listData['category']);
            
            $shoppingList = ShoppingList::create([
                'title' => $listData['title'],
                'color' => $listData['color'],
                'category_id' => $category->id,
                'user_id' => $caio->id,
            ]);

            // Adicionar produtos à lista
            foreach ($listData['products'] as $productName) {
                $product = collect($createdProducts)->firstWhere('name', $productName);
                if ($product) {
                    $shoppingList->products()->attach($product->id);
                }
            }
        }

        echo "Listas de compras criadas!\n";
        echo "Usuário Caio configurado com:\n";
        echo "- " . count($createdCategories) . " categorias\n";
        echo "- " . count($createdProducts) . " produtos\n";
        echo "- " . count($shoppingLists) . " listas de compras\n";
    }
}