# PROJECT PLAN: Aura Café - Professional Cafe Website with Admin Panel

## 📋 INFORMATION GATHERED

### Current State:

- Laravel 13 project with Blade templating
- Existing public pages: Home, Menu, About, Contact
- Design system: Brown (#2D1B10, #D4A373) and cream (#FDFBF7) colors
- Fonts: Playfair Display (serif) + Plus Jakarta Sans (sans-serif)
- Tailwind CSS via CDN, Alpine.js for mobile menu
- Authentication: Laravel Fortify ready (login/register available)
- No database models for products yet (hardcoded in views)

### Tech Stack:

- Laravel 13
- Blade templating
- Tailwind CSS (CDN)
- Alpine.js
- Vite (configured but not used with CDN Tailwind)

---

## 🎯 PLAN OVERVIEW

### Phase 1: UI Enhancements

1. Add AOS (Animate On Scroll) library
2. Create custom CSS for animations
3. Enhance Home page with missing sections

### Phase 2: Database & Models

1. Create Product model with migration
2. Create seeder for sample products
3. Update routes for products

### Phase 3: Admin Panel

1. Create admin layout (sidebar + content)
2. Create admin routes with middleware
3. Create ProductController for CRUD
4. Create admin views (dashboard, products management)

### Phase 4: Integration

1. Connect Home page to database products
2. Make public pages dynamic

---

## 📝 DETAILED TASKS

### Phase 1: UI Enhancements ✅

- [ ] 1.1 Add AOS CSS and JS to layouts/app.blade.php
- [ ] 1.2 Add custom animation styles
- [ ] 1.3 Add Gallery section to Home page
- [ ] 1.4 Add Testimonials section to Home page
- [ ] 1.5 Apply AOS attributes to existing sections

### Phase 2: Database & Models

- [ ] 2.1 Create Product migration (name, price, image, description, category)
- [ ] 2.2 Create Product model
- [ ] 2.3 Create ProductSeeder
- [ ] 2.4 Run migration and seed

### Phase 3: Admin Panel

- [ ] 3.1 Create admin layout (layouts/admin.blade.php)
- [ ] 3.2 Create admin routes (prefix: /admin, middleware: auth)
- [ ] 3.3 Create ProductController (index, create, store, edit, update, destroy)
- [ ] 3.4 Create dashboard view (admin/dashboard.blade.php)
- [ ] 3.5 Create products index view
- [ ] 3.6 Create products create/edit view

### Phase 4: Integration

- [ ] 4.1 Update Home page to fetch featured products from DB
- [ ] 4.2 Update Menu page to fetch products from DB

---

## 📁 FILES TO MODIFY

### New Files:

- app/Models/Product.php
- database/migrations/xxxx_xx_xx_create_products_table.php
- database/seeders/ProductSeeder.php
- app/Http/Controllers/Admin/ProductController.php
- resources/views/layouts/admin.blade.php
- resources/views/admin/dashboard.blade.php
- resources/views/admin/products/index.blade.php
- resources/views/admin/products/create.blade.php
- resources/views/admin/products/edit.blade.php

### Modified Files:

- resources/views/layouts/app.blade.php (add AOS)
- resources/views/pages/home.blade.php (add Gallery, Testimonials, AOS)
- routes/web.php (add admin routes)

---

## 🚀 IMPLEMENTATION ORDER

1. Start with Phase 1 (UI enhancements) - no database changes
2. Then Phase 2 (Database setup)
3. Then Phase 3 (Admin Panel)
4. Finally Phase 4 (Integration)

---

## ✅ CONFIRMATION NEEDED

This plan covers all requirements:

- ✓ Professional cafe website design
- ✓ Clean, minimalist brown/beige palette
- ✓ Smooth AOS animations
- ✓ Gallery section (Instagram-style grid)
- ✓ Testimonials section
- ✓ Admin panel with authentication
- ✓ Product CRUD management
- ✓ Fully responsive design

**Ready to implement?**
