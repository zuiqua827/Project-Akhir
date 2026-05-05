<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Values
        AboutContent::create([
            'type' => 'value',
            'image' => '☕',
            'title' => 'Quality First',
            'description' => 'We source only the finest single-origin beans from ethical farms worldwide.',
            'order' => 0,
        ]);

        AboutContent::create([
            'type' => 'value',
            'image' => '🌱',
            'title' => 'Sustainability',
            'description' => 'Every step of our process is designed to minimize environmental impact.',
            'order' => 1,
        ]);

        AboutContent::create([
            'type' => 'value',
            'image' => '❤️',
            'title' => 'Community',
            'description' => 'We believe coffee is a catalyst for meaningful connections and conversations.',
            'order' => 2,
        ]);

        AboutContent::create([
            'type' => 'value',
            'image' => '✨',
            'title' => 'Craftmanship',
            'description' => 'Our baristas are trained for months to perfect every cup they serve.',
            'order' => 3,
        ]);

        // Timeline
        AboutContent::create([
            'type' => 'timeline',
            'title' => 'A New Beginning',
            'description' => 'Café opens its doors, bringing specialty coffee to the heart of Jakarta.',
            'year' => '2024',
            'order' => 0,
        ]);

        AboutContent::create([
            'type' => 'timeline',
            'title' => 'Growing Family',
            'description' => 'We launch our loyalty program and welcome over 10,000 happy customers.',
            'year' => 'Q2 2024',
            'order' => 1,
        ]);

        AboutContent::create([
            'type' => 'timeline',
            'title' => 'Direct Trade',
            'description' => 'Established direct partnerships with coffee farmers in Sumatra and Java.',
            'year' => 'Q3 2024',
            'order' => 2,
        ]);

        AboutContent::create([
            'type' => 'timeline',
            'title' => 'Recognition',
            'description' => 'Awarded Best Specialty Coffee Shop in Jakarta by local food critics.',
            'year' => 'Q4 2024',
            'order' => 3,
        ]);

        // Team
        AboutContent::create([
            'type' => 'team',
            'image' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&q=80&w=600',
            'title' => 'Sarah Mitchell',
            'description' => 'Head Barista',
            'order' => 0,
        ]);

        AboutContent::create([
            'type' => 'team',
            'image' => 'https://images.unsplash.com/photo-1556157382-97edd2f9e4c7?auto=format&fit=crop&q=80&w=600',
            'title' => 'James Chen',
            'description' => 'Master Roaster',
            'order' => 1,
        ]);

        AboutContent::create([
            'type' => 'team',
            'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=600',
            'title' => 'Emma Laurent',
            'description' => 'Founder',
            'order' => 2,
        ]);
    }
}
