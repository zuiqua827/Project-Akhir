<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('admin can search products by name and category', function () {
    $user = User::factory()->create();

    $coffee = ProductCategory::create([
        'slug' => 'coffee',
        'name' => 'Coffee',
        'order' => 1,
    ]);

    $tea = ProductCategory::create([
        'slug' => 'tea',
        'name' => 'Tea',
        'order' => 2,
    ]);

    Product::create([
        'name' => 'Kopi Susu',
        'price' => 28000,
        'description' => 'Racikan kopi dengan susu segar.',
        'image' => 'https://example.com/kopi.jpg',
        'slug' => Str::slug('Kopi Susu'),
        'product_category_id' => $coffee->id,
        'is_available' => true,
        'is_featured' => false,
        'is_special' => false,
    ]);

    Product::create([
        'name' => 'Teh Tarik',
        'price' => 22000,
        'description' => 'Teh creamy favorit.',
        'image' => 'https://example.com/teh.jpg',
        'slug' => Str::slug('Teh Tarik'),
        'product_category_id' => $tea->id,
        'is_available' => true,
        'is_featured' => false,
        'is_special' => false,
    ]);

    $response = $this->actingAs($user)->get(route('admin.products.index', ['q' => 'Coffee']));

    $response->assertOk();
    $response->assertSee('Kopi Susu');
    $response->assertDontSee('Teh Tarik');
});

test('public menu search only returns matching available products', function () {
    $coffee = ProductCategory::create([
        'slug' => 'coffee',
        'name' => 'Coffee',
        'order' => 1,
    ]);

    Product::create([
        'name' => 'Kopi Gula Aren',
        'price' => 30000,
        'description' => 'Kopi manis dengan gula aren.',
        'image' => 'https://example.com/aren.jpg',
        'slug' => Str::slug('Kopi Gula Aren'),
        'product_category_id' => $coffee->id,
        'is_available' => true,
        'is_featured' => true,
        'is_special' => false,
    ]);

    Product::create([
        'name' => 'Kopi Legacy',
        'price' => 29000,
        'description' => 'Produk lama yang sedang tidak tersedia.',
        'image' => 'https://example.com/legacy.jpg',
        'slug' => Str::slug('Kopi Legacy'),
        'product_category_id' => $coffee->id,
        'is_available' => false,
        'is_featured' => false,
        'is_special' => false,
    ]);

    Product::create([
        'name' => 'Matcha Latte',
        'price' => 32000,
        'description' => 'Minuman teh hijau.',
        'image' => 'https://example.com/matcha.jpg',
        'slug' => Str::slug('Matcha Latte'),
        'product_category_id' => $coffee->id,
        'is_available' => true,
        'is_featured' => false,
        'is_special' => false,
    ]);

    $response = $this->get(route('menu', ['q' => 'Kopi']));

    $response->assertOk();
    $response->assertSee('Kopi Gula Aren');
    $response->assertDontSee('Kopi Legacy');
    $response->assertDontSee('Matcha Latte');
});
