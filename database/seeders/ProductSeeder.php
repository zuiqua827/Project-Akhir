<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Build a slug → id map from the product_categories table
        $categoryMap = ProductCategory::pluck('id', 'slug')->toArray();

        $products = [
            // Signature Coffees
            [
                'name' => 'Signature Espresso',
                'price' => 45000,
                'description' => 'Espresso khas dengan rasa yang kuat, pekat, lembut, dan sentuhan karamel di akhir.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600',
                'slug' => 'signature-espresso',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Velvet Latte',
                'price' => 55000,
                'description' => 'Espresso double shot dengan susu segar yang di-steam lembut hingga menciptakan tekstur selembut beludru.',
                'image' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=600',
                'slug' => 'velvet-latte',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Cloud Cappuccino',
                'price' => 50000,
                'description' => 'Perpaduan klasik espresso yang mantap, susu hangat, dan foam tebal selembut awan.',
                'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&q=80&w=600',
                'slug' => 'cloud-cappuccino',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Cold Brew Nitro',
                'price' => 60000,
                'description' => 'Kopi seduh dingin yang diekstraksi selama 24 jam dan diinfusi dengan nitrogen untuk rasa creamy alami.',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&q=80&w=600',
                'slug' => 'cold-brew-nitro',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => true,
                'is_special' => false,
                'is_available' => true,
            ],
            // Specialty Drinks
            [
                'name' => 'Caramel Macadamia Latte',
                'price' => 75000,
                'description' => 'Latte dengan saus karamel gurih buatan sendiri dan taburan kacang macadamia panggang yang renyah.',
                'image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&q=80&w=600',
                'slug' => 'caramel-macadamia-latte',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => true,
                'is_available' => true,
            ],
            [
                'name' => 'Matcha Latte',
                'price' => 55000,
                'description' => 'Matcha Jepang premium berkualitas tinggi yang diseduh dengan susu segar hangat.',
                'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=600',
                'slug' => 'matcha-latte',
                'product_category_id' => $categoryMap['tea'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Mocha Blend',
                'price' => 60000,
                'description' => 'Perpaduan sempurna antara saus cokelat ganache yang manis dan espresso yang kuat.',
                'image' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?auto=format&fit=crop&q=80&w=600',
                'slug' => 'mocha-blend',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Flat White',
                'price' => 52500,
                'description' => 'Double shot espresso dengan lapisan microfoam susu yang sangat halus dan tipis.',
                'image' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&q=80&w=600',
                'slug' => 'flat-white',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            // Quick Selections
            [
                'name' => 'Affogato',
                'price' => 70000,
                'description' => 'Satu scoop gelato vanilla premium yang disiram dengan espresso panas yang pekat.',
                'image' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&q=80&w=600',
                'slug' => 'affogato',
                'product_category_id' => $categoryMap['food'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Macchiato',
                'price' => 40000,
                'description' => 'Espresso pekat dengan sedikit tambahan foam susu di bagian atasnya.',
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=600',
                'slug' => 'macchiato',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Americano',
                'price' => 35000,
                'description' => 'Espresso murni yang diencerkan dengan air panas untuk menghasilkan rasa kopi yang bersih dan mantap.',
                'image' => 'https://images.unsplash.com/photo-1510707577719-ae7c16805a38?auto=format&fit=crop&q=80&w=600',
                'slug' => 'americano',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Espresso',
                'price' => 30000,
                'description' => 'Ekstraksi konsentrat kopi murni dari biji kopi pilihan dengan aroma kuat dan crema tebal.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&q=80&w=600',
                'slug' => 'espresso',
                'product_category_id' => $categoryMap['coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            // Non-Coffee
            [
                'name' => 'Artisan Tea',
                'price' => 45000,
                'description' => 'Pilihan teh daun premium berkualitas tinggi yang diseduh sempurna dengan aroma menenangkan.',
                'image' => 'https://images.unsplash.com/photo-1597318181409-cf64d0b5d8a2?auto=format&fit=crop&q=80&w=600',
                'slug' => 'artisan-tea',
                'product_category_id' => $categoryMap['tea'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Hot Chocolate',
                'price' => 50000,
                'description' => 'Cokelat Belgia premium yang dilelehkan ke dalam susu segar hangat yang creamy.',
                'image' => 'https://images.unsplash.com/photo-1542993243-a7c68aaf5b48?auto=format&fit=crop&q=80&w=600',
                'slug' => 'hot-chocolate',
                'product_category_id' => $categoryMap['non-coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Chai Latte',
                'price' => 52500,
                'description' => 'Teh rempah chai khas India yang harum, diseduh bersama susu hangat yang lembut.',
                'image' => 'https://images.unsplash.com/photo-1542665189-3bf51f0a6241?auto=format&fit=crop&q=80&w=600',
                'slug' => 'chai-latte',
                'product_category_id' => $categoryMap['tea'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
            [
                'name' => 'Fresh Juice',
                'price' => 60000,
                'description' => 'Jus segar dari buah-buahan musiman pilihan yang diperas langsung saat dipesan.',
                'image' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?auto=format&fit=crop&q=80&w=600',
                'slug' => 'fresh-juice',
                'product_category_id' => $categoryMap['non-coffee'] ?? null,
                'is_featured' => false,
                'is_special' => false,
                'is_available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
