<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));

        if (!Schema::hasTable((new Product())->getTable()) || !Schema::hasTable((new ProductCategory())->getTable())) {
            return view('pages.menu', [
                'categories' => collect(),
                'heroSettings' => SiteSetting::getGroup('menu_hero'),
                'keyword' => $keyword,
            ]);
        }

        $applyProductSearch = function ($query) use ($keyword) {
            if ($keyword === '') {
                return;
            }

            $query->where(function ($searchQuery) use ($keyword) {
                $searchQuery->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        };

        // Ambil semua kategori yang memiliki produk tersedia, terurut
        $categories = ProductCategory::ordered()
            ->with(['products' => function ($query) use ($applyProductSearch) {
                $query->where('is_available', true)
                    ->orderByDesc('is_featured');
                $applyProductSearch($query);
            }])
            ->whereHas('products', function ($query) use ($applyProductSearch) {
                $query->where('is_available', true);
                $applyProductSearch($query);
            })
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'items' => $category->products,
                ];
            });

        $heroSettings = SiteSetting::getGroup('menu_hero');

        return view('pages.menu', compact('categories', 'heroSettings', 'keyword'));
    }

    public function show(string $slug): View
    {
        if (!Schema::hasTable((new Product())->getTable())) {
            abort(404);
        }

        $menuProduct = Product::query()
            ->where('is_available', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.menu-detail', [
            'product' => $menuProduct,
        ]);
    }
}
