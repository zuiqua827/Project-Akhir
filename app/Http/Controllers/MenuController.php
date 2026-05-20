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
        $selectedCategory = trim((string) $request->query('category', ''));
        $showAllItems = $request->query('show') === 'all';
        $isAllCategoryView = $selectedCategory === '';
        $isLimitedAllCategory = false;
        $allCategoryTotalItems = 0;

        if (!Schema::hasTable((new Product())->getTable()) || !Schema::hasTable((new ProductCategory())->getTable())) {
            return view('pages.menu', [
                'categories' => collect(),
                'heroSettings' => SiteSetting::getGroup('menu_hero'),
                'keyword' => $keyword,
                'availableCategories' => collect(),
                'selectedCategory' => $selectedCategory,
                'selectedCategoryName' => '',
                'showAllItems' => $showAllItems,
                'isAllCategoryView' => $isAllCategoryView,
                'isLimitedAllCategory' => $isLimitedAllCategory,
                'allCategoryTotalItems' => $allCategoryTotalItems,
            ]);
        }

        $availableCategories = ProductCategory::ordered()
            ->whereHas('products', function ($query) {
                $query->where('is_available', true);
            })
            ->get(['id', 'slug', 'name']);

        if ($selectedCategory !== '' && ! $availableCategories->contains('slug', $selectedCategory)) {
            $selectedCategory = '';
            $isAllCategoryView = true;
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

        if ($isAllCategoryView) {
            $allProductsQuery = Product::query()
                ->with('category')
                ->where('is_available', true);

            $applyProductSearch($allProductsQuery);

            $allCategoryTotalItems = (clone $allProductsQuery)->count();
            $isLimitedAllCategory = ! $showAllItems && $allCategoryTotalItems > 12;

            $allProductsQuery
                ->orderByDesc('is_featured')
                ->orderBy('id');

            if (! $showAllItems) {
                $allProductsQuery->limit(12);
            }

            $categories = collect([
                [
                    'slug' => 'all',
                    'name' => 'Semua Menu',
                    'items' => $allProductsQuery->get(),
                ],
            ]);
        } else {
            // Ambil kategori terpilih yang memiliki produk tersedia, terurut
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
                ->where('slug', $selectedCategory)
                ->get()
                ->map(function ($category) {
                    return [
                        'slug' => $category->slug,
                        'name' => $category->name,
                        'items' => $category->products,
                    ];
                });
        }

        $heroSettings = SiteSetting::getGroup('menu_hero');
        $selectedCategoryName = (string) ($availableCategories->firstWhere('slug', $selectedCategory)->name ?? '');

        return view('pages.menu', compact(
            'categories',
            'heroSettings',
            'keyword',
            'availableCategories',
            'selectedCategory',
            'selectedCategoryName',
            'showAllItems',
            'isAllCategoryView',
            'isLimitedAllCategory',
            'allCategoryTotalItems'
        ));
    }

    public function show(string $slug): View
    {
        if (!Schema::hasTable((new Product())->getTable())) {
            abort(404);
        }

        $menuProduct = Product::query()
            ->with('category')
            ->where('is_available', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.menu-detail', [
            'product' => $menuProduct,
        ]);
    }

    public function showBestSeller(string $slug): View
    {
        if (!Schema::hasTable((new Product())->getTable())) {
            abort(404);
        }

        $featuredProducts = Product::query()
            ->with('category')
            ->where('is_available', true)
            ->where('is_featured', true)
            ->orderBy('id')
            ->get();

        if ($featuredProducts->isEmpty()) {
            abort(404);
        }

        $currentIndex = $featuredProducts->search(function ($item) use ($slug) {
            return $item->slug === $slug;
        });

        if ($currentIndex === false) {
            abort(404);
        }

        $currentProduct = $featuredProducts->get($currentIndex);
        $previousProduct = $currentIndex > 0 ? $featuredProducts->get($currentIndex - 1) : null;
        $nextProduct = $currentIndex < ($featuredProducts->count() - 1) ? $featuredProducts->get($currentIndex + 1) : null;

        return view('pages.best-seller-detail', [
            'product' => $currentProduct,
            'previousProduct' => $previousProduct,
            'nextProduct' => $nextProduct,
            'currentPosition' => $currentIndex + 1,
            'totalProducts' => $featuredProducts->count(),
        ]);
    }
}
