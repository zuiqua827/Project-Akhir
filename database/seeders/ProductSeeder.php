<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Signature Coffees
            [
                'name' => 'Signature Espresso',
                'price' => 4.50,
                'description' => 'Rich, dark, and smooth with a caramel finish.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600',
                'category' => 'signature',
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Velvet Latte',
                'price' => 5.50,
                'description' => 'Creamy steamed milk poured over double espresso.',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=600',
                'category' => 'signature',
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Cloud Cappuccino',
                'price' => 5.00,
                'description' => 'Traditional balance of espresso, milk, and deep foam.',
                'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&q=80&w=600',
                'category' => 'signature',
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Cold Brew Nitro',
                'price' => 6.00,
                'description' => 'Slow-steeped for 24 hours, infused with nitrogen.',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&q=80&w=600',
                'category' => 'signature',
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            // Specialty Drinks
            [
                'name' => 'Caramel Macadamia Latte',
                'price' => 7.50,
                'description' => 'House-made salted caramel with crushed roasted macadamia.',
                'image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&q=80&w=600',
                'category' => 'specialty',
                'is_featured' => false,
                'is_special' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Matcha Latte',
                'price' => 5.50,
                'description' => 'Premium Japanese matcha blended with steamed milk.',
                'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=600',
                'category' => 'specialty',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Mocha Blend',
                'price' => 6.00,
                'description' => 'Rich chocolate ganache meets bold espresso.',
                'image' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&q=80&w=600',
                'category' => 'specialty',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Flat White',
                'price' => 5.25,
                'description' => 'Smooth espresso with velvety microfoam.',
                'image' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&q=80&w=600',
                'category' => 'specialty',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            // Quick Selections
            [
                'name' => 'Affogato',
                'price' => 7.00,
                'description' => 'Espresso poured over vanilla gelato.',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&q=80&w=600',
                'category' => 'quick',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Macchiato',
                'price' => 4.00,
                'description' => 'Espresso with a splash of milk.',
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=600',
                'category' => 'quick',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Americano',
                'price' => 3.50,
                'description' => 'Rich espresso diluted with hot water.',
                'image' => 'https://images.unsplash.com/photo-1510707577719-ae7c16805a38?auto=format&fit=crop&q=80&w=600',
                'category' => 'quick',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Espresso',
                'price' => 3.00,
                'description' => 'Single or double shot of our signature blend.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600',
                'category' => 'quick',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            // Non-Coffee
            [
                'name' => 'Artisan Tea',
                'price' => 4.50,
                'description' => 'Premium loose-leaf tea selection.',
                'image' => 'https://images.unsplash.com/photo-1597318181409-cf64d0b5d8a2?auto=format&fit=crop&q=80&w=600',
                'category' => 'non-coffee',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Hot Chocolate',
                'price' => 5.00,
                'description' => 'Belgian chocolate melted into steamed milk.',
                'image' => 'https://images.unsplash.com/photo-1542993243-a7c68aaf5b48?auto=format&fit=crop&q=80&w=600',
                'category' => 'non-coffee',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Chai Latte',
                'price' => 5.25,
                'description' => 'Spiced chai blended with milk.',
                'image' => 'https://images.unsplash.com/photo-1542665189-3bf51f0a6241?auto=format&fit=crop&q=80&w=600',
                'category' => 'non-coffee',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Fresh Juice',
                'price' => 6.00,
                'description' => 'Seasonal fruits, freshly pressed.',
                'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?auto=format&fit=crop&q=80&w=600',
                'category' => 'non-coffee',
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
