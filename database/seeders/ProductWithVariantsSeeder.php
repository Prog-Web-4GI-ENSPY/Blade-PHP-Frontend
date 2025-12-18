<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;

class ProductWithVariantsSeeder extends Seeder
{
    public function run()
    {
        // Créer une catégorie si elle n'existe pas
        $category = Category::firstOrCreate([
            'name' => 'Vêtements',
            'slug' => 'vetements'
        ]);
        
        // Produit 1: T-Shirt
        $tshirt = Product::create([
            'name' => 'T-Shirt Basique',
            'slug' => 't-shirt-basique',
            'description' => 'Un t-shirt basique de haute qualité en coton.',
            'price' => 29.99,
            'stock' => 0, // Le stock sera calculé à partir des variantes
            'category_id' => $category->id,
            'is_visible' => true,
            'is_featured' => true,
        ]);
        
        // Variantes du T-Shirt
        $tshirtVariants = [
            [
                'name' => 'Rouge - S',
                'sku' => 'TSH-RED-S',
                'price' => 29.99,
                'stock' => 50,
                 'color' => 'red', // AJOUTE
                
                'attributes' => ['color' => 'red', 'size' => 'S'],
'image' => "https://pinterest.comkjkjkk"            ],
            [
                'name' => 'Rouge - M',
                'sku' => 'TSH-RED-M',
                'price' => 29.99,
                'stock' => 75,
                 'color' => 'red', // AJOUTE
                
                'attributes' => ['color' => 'red', 'size' => 'M'],
'image' => "https://pinterest.comkjkjkk"

            ],
            [
                'name' => 'Bleu - L',
                'sku' => 'TSH-BLUE-L',
                'price' => 29.99,
                'stock' => 60,
                 'color' => 'red', // AJOUTE
                'attributes' => ['color' => 'blue', 'size' => 'L'],
'image' => "https://pinterest.comkjkjkk"
            ],
            [
                'name' => 'Noir - XL',
                'sku' => 'TSH-BLACK-XL',
                'price' => 32.99,
                'stock' => 40,
                 'color' => 'red', // AJOUTE
                'attributes' => ['color' => 'black', 'size' => 'XL'],
'image' => "https://pinterest.comkjkjkk"
            ],
        ];
        
        foreach ($tshirtVariants as $variantData) {
            ProductVariant::create(array_merge($variantData, ['productId' => $tshirt->id]));
        }
        
        // Mettre à jour le stock total du produit
       $totalStock = ProductVariant::where('productId', $tshirt->id)->sum('stock');
       $tshirt->update(['stock' => $totalStock]);
        
        // Produit 2: Jeans
        $jeans = Product::create([
            'name' => 'Jeans Slim',
            'slug' => 'jeans-slim',
            'description' => 'Jeans slim fit de qualité premium.',
            'price' => 79.99,
            'stock' => 0,
            'category_id' => $category->id,
            'is_visible' => true,
            'is_featured' => false,
        ]);
        
        // Variantes du Jeans
        $jeansVariants = [
            [
                'name' => 'Bleu - 30/32',
                'sku' => 'JNS-BLUE-30-32',
                'price' => 79.99,
                'stock' => 30,
                 'color' => 'red', // AJOUTE
                
                'attributes' => ['color' => 'blue', 'size' => '30/32'],
'image' => "https://pinterest.comkjkjkk"
            ],
            [
                'name' => 'Bleu - 32/34',
                'sku' => 'JNS-BLUE-32-34',
                'price' => 79.99,
                'stock' => 45,
                 'color' => 'red', // AJOUTE
                
                'attributes' => ['color' => 'blue', 'size' => '32/34'],
'image' => "https://pinterest.comkjkjkk"
            ],
            [
                'name' => 'Noir - 34/36',
                'sku' => 'JNS-BLACK-34-36',
                'price' => 84.99,
                'stock' => 25,
                 'color' => 'red', // AJOUTE
                
                'attributes' => ['color' => 'black', 'size' => '34/36'],
'image' => "https://pinterest.comkjkjkk"
            ],
        ];
        
        foreach ($jeansVariants as $variantData) {
            ProductVariant::create(array_merge($variantData, ['productId' => $jeans->id]));
        }
        
        $totalStock = ProductVariant::where('productId', $jeans->id)->sum('stock');
        $jeans->update(['stock' => $totalStock]);
        
        $this->command->info('2 produits avec variantes créés!');
        $this->command->info('IDs des produits: ' . $tshirt->id . ', ' . $jeans->id);
        $this->command->info('IDs des variantes: ' . implode(', ', ProductVariant::pluck('id')->toArray()));
    }
}