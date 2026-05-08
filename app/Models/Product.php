<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const CATEGORY_LABELS = [
        'signature' => 'Kopi Signature',
        'specialty' => 'Minuman Spesial',
        'quick' => 'Pilihan Cepat',
        'non-coffee' => 'Non-Kopi',
    ];

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category',
        'is_featured',
        'is_special',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_special' => 'boolean',
        'is_available' => 'boolean',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORY_LABELS[$this->category] ?? ucfirst(str_replace('-', ' ', $this->category));
    }

    public static function categoryOptions(): array
    {
        return array_keys(self::CATEGORY_LABELS);
    }

    public static function categoryLabels(): array
    {
        return self::CATEGORY_LABELS;
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSpecial($query)
    {
        return $query->where('is_special', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
