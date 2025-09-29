<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário de teste
        $user = User::factory()->create([
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'password' => Hash::make('123456'),
        ]);

        // Executar seeder de produtos com imagens
        $this->call([
            ProductWithImagesSeeder::class,
        ]);

        // Criar categorias
        $categories = [
            ['title' => 'Supermercado', 'description' => 'Compras do dia a dia', 'color' => '#10b981'],
            ['title' => 'Farmácia', 'description' => 'Medicamentos e produtos de higiene', 'color' => '#3b82f6'],
            ['title' => 'Casa e Jardim', 'description' => 'Produtos para casa e jardim', 'color' => '#f59e0b'],
            ['title' => 'Eletrônicos', 'description' => 'Dispositivos e acessórios', 'color' => '#8b5cf6'],
            ['title' => 'Roupas', 'description' => 'Vestuário e acessórios', 'color' => '#ef4444'],
            ['title' => 'Livros', 'description' => 'Literatura e educação', 'color' => '#06b6d4'],
        ];

        foreach ($categories as $categoryData) {
            Category::create(array_merge($categoryData, ['user_id' => $user->id]));
        }

        // Buscar categorias criadas
        $supermercado = Category::where('title', 'Supermercado')->first();
        $farmacia = Category::where('title', 'Farmácia')->first();
        $casa = Category::where('title', 'Casa e Jardim')->first();
        $eletronicos = Category::where('title', 'Eletrônicos')->first();

        // Criar produtos
        $products = [
            // Supermercado
            ['name' => 'Arroz Branco 5kg'],
            ['name' => 'Feijão Preto 1kg'],
            ['name' => 'Açúcar Cristal 1kg'],
            ['name' => 'Óleo de Soja 900ml'],
            ['name' => 'Leite Integral 1L'],
            ['name' => 'Pão de Forma'],
            ['name' => 'Ovos Brancos (dúzia)'],
            ['name' => 'Banana Prata (kg)'],
            ['name' => 'Tomate (kg)'],
            ['name' => 'Cebola (kg)'],

            // Farmácia
            ['name' => 'Shampoo Anticaspa'],
            ['name' => 'Pasta de Dente'],
            ['name' => 'Sabonete Líquido'],
            ['name' => 'Vitamina C'],
            ['name' => 'Protetor Solar FPS 60'],

            // Casa e Jardim
            ['name' => 'Detergente Neutro'],
            ['name' => 'Amaciante de Roupas'],
            ['name' => 'Papel Higiênico (12 rolos)'],
            ['name' => 'Lâmpada LED 12W'],

            // Eletrônicos
            ['name' => 'Cabo USB-C'],
            ['name' => 'Fone de Ouvido Bluetooth'],
            ['name' => 'Carregador Portátil'],
        ];

        foreach ($products as $productData) {
            Product::create(array_merge($productData, ['user_id' => $user->id]));
        }

        // Criar listas de compras
        $lists = [
            [
                'title' => 'Compras da Semana',
                'description' => 'Lista principal de compras semanais',
                'color' => '#10b981',
                'category_id' => $supermercado->id,
            ],
            [
                'title' => 'Farmácia - Urgente',
                'description' => 'Medicamentos e produtos de higiene necessários',
                'color' => '#3b82f6',
                'category_id' => $farmacia->id,
            ],
            [
                'title' => 'Casa Nova',
                'description' => 'Itens para organizar a casa nova',
                'color' => '#f59e0b',
                'category_id' => $casa->id,
            ],
        ];

        foreach ($lists as $listData) {
            $list = ShoppingList::create(array_merge($listData, ['user_id' => $user->id]));

            // Adicionar alguns produtos às listas
            if ($list->title === 'Compras da Semana') {
                $productIds = [
                    Product::where('name', 'Arroz Branco 5kg')->first()->id,
                    Product::where('name', 'Feijão Preto 1kg')->first()->id,
                    Product::where('name', 'Leite Integral 1L')->first()->id,
                    Product::where('name', 'Banana Prata (kg)')->first()->id,
                ];
            } elseif ($list->title === 'Farmácia - Urgente') {
                $productIds = [
                    Product::where('name', 'Shampoo Anticaspa')->first()->id,
                    Product::where('name', 'Vitamina C')->first()->id,
                ];
            } else {
                $productIds = [
                    Product::where('name', 'Detergente Neutro')->first()->id,
                    Product::where('name', 'Lâmpada LED 12W')->first()->id,
                ];
            }

            $list->products()->attach($productIds);
        }
    }
}
