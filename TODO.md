- [x] Update routes/web.php: ubah parameter di menu.show dari {product} (id) ke {product:slug}

- [x] Update app/Http/Controllers/MenuController.php: method show menerima Product $product (route model binding) dan difilter is_available
- [x] Update resources/views/pages/menu.blade.php: ubah route('menu.show', $item->id) menjadi $item->slug

- [ ] Pisahkan kategori: buat tabel `product_categories` dan relasi ke `products` (ganti products.category string -> product_category_id)
- [ ] Buat migration produk baru: add product_category_id + foreign key, lalu drop products.category
- [ ] Update app/Models/Product.php: relasi belongsTo ProductCategory + label dari relasi
- [ ] Buat app/Models/ProductCategory.php
- [ ] Update MenuController + view: group kategori lewat relasi (product_category)
- [ ] Update Admin Product CRUD + blade: select kategori dari tabel product_categories
- [ ] Update seeder ProductSeeder: set product_category_id dari slug kategori
- [ ] Jalankan: php artisan migrate (atau migrasi ulang) lalu php artisan db:seed
