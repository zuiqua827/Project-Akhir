<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SiteSetting;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        // Ambil semua kategori yang memiliki produk tersedia, terurut
        $categories = ProductCategory::ordered()
            ->with(['products' => function ($query) {
                $query->where('is_available', true)
                      ->orderByDesc('is_featured');
            }])
            ->whereHas('products', function ($query) {
                $query->where('is_available', true);
            })
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'items' => $category->products,
                ];
            });

        $heroSettings = SiteSetting::getGroup('menu_hero');

        return view('pages.menu', compact('categories', 'heroSettings'));
    }

    public function show(Product $product): View
    {
        $menuProduct = Product::query()
            ->where('is_available', true)
            ->where('slug', $product->slug)
            ->firstOrFail();

        return view('pages.menu-detail', [
            'product' => $menuProduct,
        ]);
    }
}
