<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'coffee',     'name' => 'Coffee',       'order' => 1],
            ['slug' => 'non-coffee', 'name' => 'Non Coffee',   'order' => 2],
            ['slug' => 'tea',        'name' => 'Tea',          'order' => 3],
            ['slug' => 'food',       'name' => 'Food',         'order' => 4],
            ['slug' => 'snack',      'name' => 'Snack',        'order' => 5],
        ];

        foreach ($categories as $category) {
            ProductCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
