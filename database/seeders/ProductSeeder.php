<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin Shopecart',
            'email' => 'admin@shopecart.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Créer les catégories
        $categories = [
            [
                'name' => 'Électronique',
                'slug' => 'electronique',
                'description' => 'Smartphones, ordinateurs et accessoires high-tech',
                'is_visible' => true,
            ],
            [
                'name' => 'Mode',
                'slug' => 'mode',
                'description' => 'Vêtements, chaussures et accessoires de mode',
                'is_visible' => true,
            ],
            [
                'name' => 'Maison',
                'slug' => 'maison',
                'description' => 'Décoration, meubles et accessoires pour la maison',
                'is_visible' => true,
            ],
            [
                'name' => 'Sport',
                'slug' => 'sport',
                'description' => 'Équipements sportifs et vêtements de sport',
                'is_visible' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Récupérer les catégories
        $electronics = Category::where('slug', 'electronique')->first();
        $fashion = Category::where('slug', 'mode')->first();
        $home = Category::where('slug', 'maison')->first();
        $sports = Category::where('slug', 'sport')->first();

        // Créer des produits
        $products = [
            // Produits Électronique
            [
                'name' => 'iPhone 15 Pro Max',
                'slug' => 'iphone-15-pro-max',
                'description' => 'iPhone 15 Pro Max avec écran 6.7 pouces, caméra 48MP et puce A17 Pro.',
                'price' => 1299.99,
                'compare_price' => 1399.99,
                'stock' => 25,
                'sku' => 'IP15PROMAX256',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'description' => 'Smartphone Android flagship avec stylet S-Pen et caméra 200MP.',
                'price' => 1199.99,
                'compare_price' => 1299.99,
                'stock' => 30,
                'sku' => 'SGS24ULTRA512',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'MacBook Air M3',
                'slug' => 'macbook-air-m3',
                'description' => 'Ordinateur portable Apple avec puce M3, 13 pouces, 8GB RAM, 256GB SSD.',
                'price' => 1099.99,
                'stock' => 15,
                'sku' => 'MBAM3132024',
                'is_visible' => true,
                'is_featured' => false,
                'published_at' => now(),
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'AirPods Pro 2',
                'slug' => 'airpods-pro-2',
                'description' => 'Écouteurs sans fil avec réduction de bruit active et boîtier MagSafe.',
                'price' => 249.99,
                'compare_price' => 279.99,
                'stock' => 50,
                'sku' => 'AIRPODSPRO2',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $electronics->id,
            ],

            // Produits Mode
            [
                'name' => 'T-shirt Cotton Basique',
                'slug' => 't-shirt-cotton-basique',
                'description' => 'T-shirt 100% coton, coupe regular, disponible en plusieurs coloris.',
                'price' => 19.99,
                'compare_price' => 24.99,
                'stock' => 100,
                'sku' => 'TSHIRT-BLK-M',
                'is_visible' => true,
                'is_featured' => false,
                'published_at' => now(),
                'category_id' => $fashion->id,
            ],
            [
                'name' => 'Jean Slim Noir',
                'slug' => 'jean-slim-noir',
                'description' => 'Jean slim stretch noir, coupe moderne et confortable.',
                'price' => 59.99,
                'compare_price' => 79.99,
                'stock' => 40,
                'sku' => 'JEAN-SLIM-NR',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $fashion->id,
            ],
            [
                'name' => 'Chaussures de Sport',
                'slug' => 'chaussures-sport',
                'description' => 'Chaussures de sport légères et respirantes pour running et fitness.',
                'price' => 89.99,
                'stock' => 35,
                'sku' => 'SHOES-RUN-BLK',
                'is_visible' => true,
                'is_featured' => false,
                'published_at' => now(),
                'category_id' => $fashion->id,
            ],

            // Produits Maison
            [
                'name' => 'Oreiller Mémoire de Forme',
                'slug' => 'oreiller-memoire-forme',
                'description' => 'Oreiller ergonomique à mémoire de forme pour un sommeil réparateur.',
                'price' => 49.99,
                'compare_price' => 69.99,
                'stock' => 60,
                'sku' => 'OREILLER-MEM',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $home->id,
            ],
            [
                'name' => 'Lampe de Bureau LED',
                'slug' => 'lampe-bureau-led',
                'description' => 'Lampe de bureau LED réglable avec chargeur USB intégré.',
                'price' => 34.99,
                'stock' => 25,
                'sku' => 'LAMP-LED-DESK',
                'is_visible' => true,
                'is_featured' => false,
                'published_at' => now(),
                'category_id' => $home->id,
            ],

            // Produits Sport
            [
                'name' => 'Yoga Mat Premium',
                'slug' => 'yoga-mat-premium',
                'description' => 'Tapis de yoga antidérapant, écologique, épaisseur 6mm.',
                'price' => 39.99,
                'compare_price' => 49.99,
                'stock' => 30,
                'sku' => 'YOGA-MAT-PRO',
                'is_visible' => true,
                'is_featured' => true,
                'published_at' => now(),
                'category_id' => $sports->id,
            ],
            [
                'name' => 'Dumbbells Adjustables',
                'slug' => 'dumbbells-adjustables',
                'description' => 'Haltères ajustables de 5 à 25kg, parfait pour l\'entraînement à domicile.',
                'price' => 129.99,
                'stock' => 20,
                'sku' => 'DUMB-ADJ-25',
                'is_visible' => true,
                'is_featured' => false,
                'published_at' => now(),
                'category_id' => $sports->id,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('✅ Données de test créées avec succès !');
        $this->command->info('👤 Admin: admin@shopecart.com / password123');
        $this->command->info('📦 Produits: ' . Product::count() . ' produits créés');
        $this->command->info('📁 Catégories: ' . Category::count() . ' catégories créées');
    }
}