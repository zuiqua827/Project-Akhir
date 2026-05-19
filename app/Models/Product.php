<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'slug',
        'product_category_id',
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

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                     */
    /* ------------------------------------------------------------------ */

    /**
     * Relasi ke tabel product_categories.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /* ------------------------------------------------------------------ */
    /*  Accessors                                                         */
    /* ------------------------------------------------------------------ */

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    /**
     * Label kategori yang diambil dari relasi.
     */
    public function getCategoryLabelAttribute(): string
    {
        return $this->category?->name ?? '';
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                            */
    /* ------------------------------------------------------------------ */

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

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('product_category_id', $categoryId);
    }
}
