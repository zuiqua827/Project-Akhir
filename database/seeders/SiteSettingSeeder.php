<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Home Hero
            ['group' => 'home_hero', 'key' => 'badge', 'value' => 'Est. 2024'],
            ['group' => 'home_hero', 'key' => 'title', 'value' => 'Freshly Brewed'],
            ['group' => 'home_hero', 'key' => 'subtitle', 'value' => 'For You.'],
            ['group' => 'home_hero', 'key' => 'description', 'value' => 'Experience the perfect balance of artisan roasting and soulful atmosphere in every single cup we serve.'],
            ['group' => 'home_hero', 'key' => 'sub_description', 'value' => 'Ethically sourced beans, roasted in small batches.'],
            ['group' => 'home_hero', 'key' => 'cta_text', 'value' => 'Explore Menu'],
            ['group' => 'home_hero', 'key' => 'background_image', 'value' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=2000'],

            // Home Gallery
            ['group' => 'home_gallery', 'key' => 'badge', 'value' => 'Our Moments'],
            ['group' => 'home_gallery', 'key' => 'title', 'value' => 'Gallery'],

            // About Hero
            ['group' => 'about_hero', 'key' => 'badge', 'value' => 'our story'],
            ['group' => 'about_hero', 'key' => 'title', 'value' => 'Beyond just'],
            ['group' => 'about_hero', 'key' => 'subtitle', 'value' => 'Coffee.'],
            ['group' => 'about_hero', 'key' => 'description1', 'value' => 'At Café, we believe that coffee is a ritual, not just a drink. Our beans are ethically sourced from the highest altitudes and roasted in small batches to preserve their unique profiles.'],
            ['group' => 'about_hero', 'key' => 'description2', 'value' => 'Whether you\'re seeking a quiet corner for reflection or a vibrant space for connection, our doors are open to provide a sanctuary of warmth and exceptional taste.'],
            ['group' => 'about_hero', 'key' => 'image1', 'value' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&q=80&w=800'],
            ['group' => 'about_hero', 'key' => 'image2', 'value' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&q=80&w=600'],

            // About Stats
            ['group' => 'about_stats', 'key' => 'stat1_value', 'value' => '100%'],
            ['group' => 'about_stats', 'key' => 'stat1_label', 'value' => 'Organic Beans'],
            ['group' => 'about_stats', 'key' => 'stat2_value', 'value' => '15+'],
            ['group' => 'about_stats', 'key' => 'stat2_label', 'value' => 'Countries Sourced'],

            // Menu Hero
            ['group' => 'menu_hero', 'key' => 'badge', 'value' => 'Est. 2024'],
            ['group' => 'menu_hero', 'key' => 'title', 'value' => 'Our Craft'],
            ['group' => 'menu_hero', 'key' => 'subtitle', 'value' => 'Menu.'],
            ['group' => 'menu_hero', 'key' => 'description', 'value' => 'Every cup is hand-crafted by our master baristas using precise temperatures and measurements for the ultimate flavor extraction.'],

            // Contact Hero
            ['group' => 'contact_hero', 'key' => 'badge', 'value' => 'Get in Touch'],
            ['group' => 'contact_hero', 'key' => 'title', 'value' => 'Visit'],
            ['group' => 'contact_hero', 'key' => 'subtitle', 'value' => 'Us.'],
            ['group' => 'contact_hero', 'key' => 'description', 'value' => 'We\'d love to hear from you. Whether you have a question about our beans, want to book an event, or just want to say hello, our door is always open.'],

            // Contact Info
            ['group' => 'contact_info', 'key' => 'address', 'value' => 'Jl. KH Achmad Fauzan No.17, Krasak, Bangsri, Kec. Bangsri, Kabupaten Jepara, Jawa Tengah 59415'],
            ['group' => 'contact_info', 'key' => 'phone', 'value' => '+62 822-2300-5860'],
            ['group' => 'contact_info', 'key' => 'email', 'value' => 'hello@cafe.com'],
            ['group' => 'contact_info', 'key' => 'maps_url', 'value' => 'https://www.google.com/maps/place/SMK+Negeri+1+Bangsri/@-6.5275824,110.7483335,17z/data=!3m1!4b1!4m6!3m5!1s0x2e71224fcb07076b:0xd0eadbcc365f1b0d!8m2!3d-6.5275877!4d110.7509084!16s%2Fg%2F1pzv_ytw7?hl=en&entry=ttu&g_ep=EgoyMDI2MDQyOC4wIKXMDSoASAFQAw%3D%3D'],
            
            // Contact Reservation
            ['group' => 'contact_reservation', 'key' => 'enabled', 'value' => '1'],
            ['group' => 'contact_reservation', 'key' => 'whatsapp_number', 'value' => '+62 822-2300-5860'],
            ['group' => 'contact_reservation', 'key' => 'title', 'value' => 'Reservasi'],
            ['group' => 'contact_reservation', 'key' => 'description', 'value' => 'Jika Ingin Reservasi Bisa Hubungi Di Sini.'],
            ['group' => 'contact_reservation', 'key' => 'button_text', 'value' => 'Kirim ke WhatsApp'],
            ['group' => 'contact_reservation', 'key' => 'template_opening', 'value' => 'Halo Admin, saya ingin reservasi dengan detail berikut:'],
            ['group' => 'contact_reservation', 'key' => 'template_closing', 'value' => 'Mohon info ketersediaannya. Terima kasih.'],
            ['group' => 'contact_reservation', 'key' => 'subject_options_json', 'value' => json_encode([
                'Pertanyaan Umum',
                'Masukan',
                'Pemesanan Acara',
                'Kemitraan',
            ], JSON_UNESCAPED_UNICODE)],

            // Contact Hours
            ['group' => 'contact_hours', 'key' => 'hours_json', 'value' => json_encode([
                ['day' => 'Senin - Jumat', 'time' => '07:00 WIB — 21:00 WIB'],
                ['day' => 'Sabtu', 'time' => '08:00 WIB — 22:00 WIB'],
                ['day' => 'Minggu', 'time' => '08:00 WIB — 20:00 WIB'],
            ])],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['group' => $setting['group'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
