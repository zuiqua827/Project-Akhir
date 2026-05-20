<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function homeHero()
    {
        $settings = SiteSetting::getGroup('home_hero');
        return view('admin.settings.home-hero', compact('settings'));
    }

    public function updateHomeHero(Request $request)
    {
        $data = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'navbar_logo_light' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'navbar_logo_dark' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        if ($request->hasFile('background_image')) {
            $existingBg = SiteSetting::get('home_hero', 'background_image');
            if (is_string($existingBg) && str_starts_with($existingBg, '/storage/')) {
                $existingPath = ltrim(substr($existingBg, strlen('/storage/')), '/');
                if ($existingPath !== '') {
                    Storage::disk('public')->delete($existingPath);
                }
            }

            $path = $request->file('background_image')->store('settings', 'public');
            $data['background_image'] = Storage::url($path);
        } else {
            unset($data['background_image']); // Don't override with null if no file chosen
        }

        foreach (['navbar_logo_light', 'navbar_logo_dark'] as $logoKey) {
            if ($request->hasFile($logoKey)) {
                $existingLogo = SiteSetting::get('home_hero', $logoKey);
                if (is_string($existingLogo) && str_starts_with($existingLogo, '/storage/')) {
                    $existingPath = ltrim(substr($existingLogo, strlen('/storage/')), '/');
                    if ($existingPath !== '') {
                        Storage::disk('public')->delete($existingPath);
                    }
                }

                $path = $request->file($logoKey)->store('settings', 'public');
                $data[$logoKey] = Storage::url($path);
            } else {
                unset($data[$logoKey]);
            }
        }

        foreach ($data as $key => $value) {
            SiteSetting::set('home_hero', $key, $value);
        }

        return back()->with('success', 'Pengaturan hero beranda berhasil diperbarui.');
    }

    public function homeGallery()
    {
        $settings = SiteSetting::getGroup('home_gallery');
        return view('admin.settings.home-gallery', compact('settings'));
    }

    public function updateHomeGallery(Request $request)
    {
        $data = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set('home_gallery', $key, $value);
        }

        return back()->with('success', 'Pengaturan galeri beranda berhasil diperbarui.');
    }

    public function homeLocation()
    {
        $settings = SiteSetting::getGroup('home_location');
        return view('admin.settings.home-location', compact('settings'));
    }

    public function updateHomeLocation(Request $request)
    {
        $data = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'hours' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'maps_query' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set('home_location', $key, $value);
        }

        return back()->with('success', 'Pengaturan lokasi berhasil diperbarui.');
    }

    public function aboutHero()
    {
        $settings = SiteSetting::getGroup('about_hero');
        return view('admin.settings.about-hero', compact('settings'));
    }

    public function updateAboutHero(Request $request)
    {
        $heroData = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image1')) {
            $existingImg1 = SiteSetting::get('about_hero', 'image1');
            if (is_string($existingImg1) && str_starts_with($existingImg1, '/storage/')) {
                $existingPath = ltrim(substr($existingImg1, strlen('/storage/')), '/');
                if ($existingPath !== '') {
                    Storage::disk('public')->delete($existingPath);
                }
            }

            $path = $request->file('image1')->store('settings', 'public');
            $heroData['image1'] = Storage::url($path);
        } else {
            unset($heroData['image1']);
        }
        
        if ($request->hasFile('image2')) {
            $existingImg2 = SiteSetting::get('about_hero', 'image2');
            if (is_string($existingImg2) && str_starts_with($existingImg2, '/storage/')) {
                $existingPath = ltrim(substr($existingImg2, strlen('/storage/')), '/');
                if ($existingPath !== '') {
                    Storage::disk('public')->delete($existingPath);
                }
            }

            $path = $request->file('image2')->store('settings', 'public');
            $heroData['image2'] = Storage::url($path);
        } else {
            unset($heroData['image2']);
        }

        foreach ($heroData as $key => $value) {
            SiteSetting::set('about_hero', $key, $value);
        }

        return back()->with('success', 'Pengaturan hero halaman tentang berhasil diperbarui.');
    }

    public function aboutValues()
    {
        $settings = SiteSetting::getGroup('about_values');
        $defaultItems = $this->defaultAboutValuesItems();

        $items = json_decode($settings['items_json'] ?? '[]', true);
        if (!is_array($items) || empty($items)) {
            $items = $defaultItems;
        }

        $valueItems = [];
        for ($index = 0; $index < 4; $index++) {
            $fallback = $defaultItems[$index] ?? ['icon' => 'fa-solid fa-star', 'title' => '', 'desc' => ''];
            $rawItem = is_array($items[$index] ?? null) ? $items[$index] : [];

            $valueItems[] = [
                'icon' => trim((string) ($rawItem['icon'] ?? $fallback['icon'])) ?: $fallback['icon'],
                'title' => trim((string) ($rawItem['title'] ?? $fallback['title'])) ?: $fallback['title'],
                'desc' => trim((string) ($rawItem['desc'] ?? $fallback['desc'])) ?: $fallback['desc'],
            ];
        }

        return view('admin.settings.about-values', compact('settings', 'valueItems'));
    }

    public function updateAboutValues(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:150',
            'description' => 'nullable|string|max:500',
            'items' => 'nullable|array|max:4',
            'items.*.icon' => 'nullable|string|max:100',
            'items.*.title' => 'nullable|string|max:120',
            'items.*.desc' => 'nullable|string|max:500',
        ]);

        $defaultItems = $this->defaultAboutValuesItems();
        $rawItems = $data['items'] ?? [];
        $normalizedItems = [];

        for ($index = 0; $index < 4; $index++) {
            $fallback = $defaultItems[$index] ?? ['icon' => 'fa-solid fa-star', 'title' => '', 'desc' => ''];
            $rawItem = is_array($rawItems[$index] ?? null) ? $rawItems[$index] : [];

            $icon = trim((string) ($rawItem['icon'] ?? ''));
            $title = trim((string) ($rawItem['title'] ?? ''));
            $desc = trim((string) ($rawItem['desc'] ?? ''));

            $normalizedItems[] = [
                'icon' => $icon !== '' ? $icon : $fallback['icon'],
                'title' => $title !== '' ? $title : $fallback['title'],
                'desc' => $desc !== '' ? $desc : $fallback['desc'],
            ];
        }

        SiteSetting::set('about_values', 'title', $data['title'] ?? '');
        SiteSetting::set('about_values', 'description', $data['description'] ?? '');
        SiteSetting::set('about_values', 'items_json', json_encode($normalizedItems, JSON_UNESCAPED_UNICODE));

        return back()->with('success', 'Pengaturan section "Yang Menggerakkan Kami" berhasil diperbarui.');
    }

    public function menuHero()
    {
        $settings = SiteSetting::getGroup('menu_hero');
        return view('admin.settings.menu-hero', compact('settings'));
    }

    public function updateMenuHero(Request $request)
    {
        $data = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set('menu_hero', $key, $value);
        }

        return back()->with('success', 'Pengaturan hero menu berhasil diperbarui.');
    }

    public function contactHero()
    {
        $settings = SiteSetting::getGroup('contact_hero');
        return view('admin.settings.contact-hero', compact('settings'));
    }

    public function updateContactHero(Request $request)
    {
        $data = $request->validate([
            'badge' => 'nullable|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set('contact_hero', $key, $value);
        }

        return back()->with('success', 'Pengaturan hero kontak berhasil diperbarui.');
    }

    public function contactInfo()
    {
        $settings = SiteSetting::getGroup('contact_info');
        $reservationSettings = SiteSetting::getGroup('contact_reservation');
        $hoursJson = SiteSetting::get('contact_hours', 'hours_json', '[]');
        $hours = json_decode($hoursJson, true);

        $reservationSubjectOptions = json_decode($reservationSettings['subject_options_json'] ?? '[]', true);
        if (!is_array($reservationSubjectOptions) || empty($reservationSubjectOptions)) {
            $reservationSubjectOptions = [
                'Pertanyaan Umum',
                'Masukan',
                'Pemesanan Acara',
                'Kemitraan',
            ];
        }
        $reservationSubjectOptionsText = implode("\n", $reservationSubjectOptions);

        return view('admin.settings.contact-info', compact('settings', 'hours', 'reservationSettings', 'reservationSubjectOptionsText'));
    }

    public function updateContactInfo(Request $request)
    {
        $data = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'maps_query' => 'nullable|string',
            'reservation_enabled' => 'nullable|in:0,1',
            'reservation_whatsapp' => 'nullable|string|max:40',
            'reservation_title' => 'nullable|string|max:150',
            'reservation_description' => 'nullable|string|max:500',
            'reservation_button_text' => 'nullable|string|max:80',
            'reservation_template_opening' => 'nullable|string|max:500',
            'reservation_template_closing' => 'nullable|string|max:500',
            'reservation_subject_options' => 'nullable|string|max:4000',
        ]);

        foreach (['address', 'phone', 'email', 'maps_query'] as $key) {
            SiteSetting::set('contact_info', $key, $data[$key] ?? null);
        }

        // Handle hours
        $hours = [];
        if ($request->has('days') && is_array($request->days)) {
            foreach ($request->days as $index => $day) {
                if (!empty($day)) {
                    $hours[] = [
                        'day' => $day,
                        'time' => $request->times[$index] ?? '',
                    ];
                }
            }
        }
        
        SiteSetting::set('contact_hours', 'hours_json', json_encode($hours));

        $subjectLines = preg_split('/\r\n|\r|\n/', (string) ($data['reservation_subject_options'] ?? ''));
        $subjectOptions = array_values(array_unique(array_filter(array_map('trim', $subjectLines))));
        if (empty($subjectOptions)) {
            $subjectOptions = [
                'Pertanyaan Umum',
                'Masukan',
                'Pemesanan Acara',
                'Kemitraan',
            ];
        }

        SiteSetting::set('contact_reservation', 'enabled', $data['reservation_enabled'] ?? '0');
        SiteSetting::set('contact_reservation', 'whatsapp_number', $data['reservation_whatsapp'] ?? '');
        SiteSetting::set('contact_reservation', 'title', $data['reservation_title'] ?? '');
        SiteSetting::set('contact_reservation', 'description', $data['reservation_description'] ?? '');
        SiteSetting::set('contact_reservation', 'button_text', $data['reservation_button_text'] ?? '');
        SiteSetting::set('contact_reservation', 'template_opening', $data['reservation_template_opening'] ?? '');
        SiteSetting::set('contact_reservation', 'template_closing', $data['reservation_template_closing'] ?? '');
        SiteSetting::set('contact_reservation', 'subject_options_json', json_encode($subjectOptions, JSON_UNESCAPED_UNICODE));

        return back()->with('success', 'Info kontak, jam operasional, dan pengaturan reservasi berhasil diperbarui.');
    }

    public function bestSeller()
    {
        $products = \App\Models\Product::where('is_available', true)->orderBy('name')->get();
        return view('admin.settings.best-seller', compact('products'));
    }

    public function updateBestSeller(Request $request)
    {
        $bestSellerIds = $request->input('best_sellers', []);

        // Reset all products is_featured to false
        \App\Models\Product::query()->update(['is_featured' => false]);

        // Set selected products as best seller (is_featured = true)
        if (!empty($bestSellerIds)) {
            \App\Models\Product::whereIn('id', $bestSellerIds)->update(['is_featured' => true]);
        }

        return back()->with('success', 'Produk terlaris berhasil diperbarui.');
    }

    public function footer()
    {
        $settings = SiteSetting::getGroup('footer');
        return view('admin.settings.footer', compact('settings'));
    }

    public function updateFooter(Request $request)
    {
        $data = $request->validate([
            'brand_name' => 'nullable|string',
            'brand_accent' => 'nullable|string',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'tagline' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'tiktok_url' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'copyright' => 'nullable|string',
            'bottom_text' => 'nullable|string',
        ]);

        if ($request->hasFile('brand_logo')) {
            $existingLogo = SiteSetting::get('footer', 'brand_logo');
            if (is_string($existingLogo) && str_starts_with($existingLogo, '/storage/')) {
                $existingPath = ltrim(substr($existingLogo, strlen('/storage/')), '/');
                if ($existingPath !== '') {
                    Storage::disk('public')->delete($existingPath);
                }
            }

            $path = $request->file('brand_logo')->store('settings', 'public');
            $data['brand_logo'] = Storage::url($path);
        } else {
            unset($data['brand_logo']);
        }

        foreach ($data as $key => $value) {
            SiteSetting::set('footer', $key, $value);
        }

        return back()->with('success', 'Pengaturan footer berhasil diperbarui.');
    }

    private function defaultAboutValuesItems(): array
    {
        return [
            [
                'icon' => 'fa-solid fa-gem',
                'title' => 'Kualitas Utama',
                'desc' => 'Kami hanya memilih biji single-origin terbaik dari kebun etis di berbagai daerah.',
            ],
            [
                'icon' => 'fa-solid fa-leaf',
                'title' => 'Keberlanjutan',
                'desc' => 'Setiap tahap proses kami dirancang untuk meminimalkan dampak lingkungan.',
            ],
            [
                'icon' => 'fa-solid fa-people-group',
                'title' => 'Komunitas',
                'desc' => 'Kami percaya kopi adalah jembatan untuk koneksi dan percakapan yang bermakna.',
            ],
            [
                'icon' => 'fa-solid fa-wand-magic-sparkles',
                'title' => 'Keahlian',
                'desc' => 'Barista kami dilatih berbulan-bulan untuk menyempurnakan setiap cangkir yang disajikan.',
            ],
        ];
    }
}
