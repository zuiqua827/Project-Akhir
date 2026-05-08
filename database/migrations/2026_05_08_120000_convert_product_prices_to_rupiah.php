<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')
            ->where('price', '<', 1000)
            ->update([
                'price' => DB::raw('price * 10000'),
            ]);
    }

    public function down(): void
    {
        DB::table('products')
            ->where('price', '>=', 10000)
            ->where('price', '<=', 10000000)
            ->update([
                'price' => DB::raw('price / 10000'),
            ]);
    }
};
