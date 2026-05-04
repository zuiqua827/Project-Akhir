<?php

namespace Database\Seeders;

use App\Models\Moment;
use Illuminate\Database\Seeder;

class MomentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Morning brew',
            'order' => 0,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Art of brewing',
            'order' => 1,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Our space',
            'order' => 2,
            'is_featured' => true,
        ]);


        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Perfect shot',
            'order' => 3,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Latte art',
            'order' => 4,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Sweet treat',
            'order' => 5,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1542993243-a7c68aaf5b48?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Chocolate',
            'order' => 6,
        ]);

        Moment::create([
            'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=600',
            'caption' => 'Matcha',
            'order' => 7,
        ]);

    }

}
