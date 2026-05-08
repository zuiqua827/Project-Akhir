<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $categoryLabels = Product::categoryLabels();

        $products = Product::query()
            ->where('is_available', true)
            ->orderBy('category')
            ->orderByDesc('is_featured')
            ->get();

        $categories = $products
            ->groupBy('category')
            ->map(function ($items, $category) use ($categoryLabels) {
                return [
                    'name' => $categoryLabels[$category] ?? str_replace('-', ' ', $category),
                    'items' => $items->values(),
                ];
            })
            ->values();

        $heroSettings = SiteSetting::getGroup('menu_hero');

        return view('pages.menu', compact('categories', 'heroSettings'));
    }

    public function show(int $product): View
    {
        $menuProduct = Product::query()
            ->where('is_available', true)
            ->findOrFail($product);

        return view('pages.menu-detail', [
            'product' => $menuProduct,
        ]);
    }
}
