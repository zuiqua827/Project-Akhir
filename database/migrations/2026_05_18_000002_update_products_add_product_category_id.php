<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the foreign key column
            $table->foreignId('product_category_id')
                ->nullable()
                ->after('slug')
                ->constrained('product_categories')
                ->cascadeOnDelete();
        });

        // Drop the old string-based category column
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->dropColumn('product_category_id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->default('coffee');
        });
    }
};
