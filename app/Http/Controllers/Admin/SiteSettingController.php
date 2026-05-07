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
        ]);

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('settings', 'public');
            $data['background_image'] = Storage::url($path);
        } else {
            unset($data['background_image']); // Don't override with null if no file chosen
        }

        foreach ($data as $key => $value) {
            SiteSetting::set('home_hero', $key, $value);
        }

        return back()->with('success', 'Home Hero settings updated successfully.');
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

        return back()->with('success', 'Home Gallery settings updated successfully.');
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

        return back()->with('success', 'Location settings updated successfully.');
    }

    public function aboutHero()
    {
        $settings = SiteSetting::getGroup('about_hero');
        $stats = SiteSetting::getGroup('about_stats');
        return view('admin.settings.about-hero', compact('settings', 'stats'));
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
            $path = $request->file('image1')->store('settings', 'public');
            $heroData['image1'] = Storage::url($path);
        } else {
            unset($heroData['image1']);
        }
        
        if ($request->hasFile('image2')) {
            $path = $request->file('image2')->store('settings', 'public');
            $heroData['image2'] = Storage::url($path);
        } else {
            unset($heroData['image2']);
        }

        $statsData = $request->validate([
            'stat1_value' => 'nullable|string',
            'stat1_label' => 'nullable|string',
            'stat2_value' => 'nullable|string',
            'stat2_label' => 'nullable|string',
        ]);

        foreach ($heroData as $key => $value) {
            SiteSetting::set('about_hero', $key, $value);
        }

        foreach ($statsData as $key => $value) {
            SiteSetting::set('about_stats', $key, $value);
        }

        return back()->with('success', 'About Hero settings updated successfully.');
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

        return back()->with('success', 'Menu Hero settings updated successfully.');
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

        return back()->with('success', 'Contact Hero settings updated successfully.');
    }

    public function contactInfo()
    {
        $settings = SiteSetting::getGroup('contact_info');
        $hoursJson = SiteSetting::get('contact_hours', 'hours_json', '[]');
        $hours = json_decode($hoursJson, true);
        return view('admin.settings.contact-info', compact('settings', 'hours'));
    }

    public function updateContactInfo(Request $request)
    {
        $infoData = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'maps_query' => 'nullable|string',
        ]);

        foreach ($infoData as $key => $value) {
            SiteSetting::set('contact_info', $key, $value);
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

        return back()->with('success', 'Contact Info & Hours updated successfully.');
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

        return back()->with('success', 'Best Seller products updated successfully.');
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
            'tagline' => 'nullable|string',
            'instagram_url' => 'nullable|string',
            'tiktok_url' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'copyright' => 'nullable|string',
            'bottom_text' => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set('footer', $key, $value);
        }

        return back()->with('success', 'Footer settings updated successfully.');
    }
}
