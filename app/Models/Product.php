<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'description',
        'description_en',
        'short_description',
        'price',
        'compare_price',
        'cost_price',
        'sku',
        'stock_quantity',
        'track_stock',
        'is_active',
        'is_featured',
        'images',
        'meta_title',
        'meta_description',
        'weight',
        'dimensions',
        'sort_order',
        'category_id',
        'unit_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'stock_quantity' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'track_stock' => 'boolean',
        'images' => 'array',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = strtoupper(Str::random(8));
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * Get the category that owns the product
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the unit that belongs to the product
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the orders for the product
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(related: ProductVariant::class);
    }

    /**
     * Scope for active products
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for in stock products
     */
    public function scopeInStock($query)
    {
        return $query->where(function ($q) {
            $q->where('track_stock', false)
                ->orWhere('stock_quantity', '>', 0);
        });
    }

    /**
     * Scope for ordered products
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get formatted price with BDT currency
     */
    public function getFormattedPriceAttribute(): string
    {
        return format_bdt((float) $this->price);
    }

    /**
     * Get formatted compare price with BDT currency
     */
    public function getFormattedComparePriceAttribute(): string
    {
        return $this->compare_price ? format_bdt((float) $this->compare_price) : '';
    }

    /**
     * Get the main product image
     */
    public function getMainImageAttribute(): string
    {
        if (!empty($this->images) && is_array($this->images)) {
            return asset('storage/' . $this->images[0]);
        }
        return asset('images/default-product.png');
    }

    /**
     * Get all product image URLs
     */
    public function getImageUrlsAttribute(): array
    {
        if (!empty($this->images) && is_array($this->images)) {
            return array_map(function ($image) {
                return asset('storage/' . $image);
            }, $this->images);
        }
        return [asset('images/default-product.png')];
    }

    /**
     * Check if product is in stock
     */
    public function isInStock(): bool
    {
        return !$this->track_stock || $this->stock_quantity > 0;
    }

    /**
     * Check if product is on sale
     */
    public function isOnSale(): bool
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->isOnSale()) {
            return 0;
        }
        return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    /**
     * Get stock status text
     */
    public function getStockStatusAttribute(): string
    {
        if (!$this->track_stock) {
            return 'In Stock';
        }

        if ($this->stock_quantity > 10) {
            return 'In Stock';
        } elseif ($this->stock_quantity > 0) {
            return 'Low Stock';
        } else {
            return 'Out of Stock';
        }
    }

    /**
     * Get stock status color class
     */
    public function getStockStatusColorAttribute(): string
    {
        $status = $this->stock_status;

        return match ($status) {
            'In Stock' => 'text-green-600 bg-green-100',
            'Low Stock' => 'text-yellow-600 bg-yellow-100',
            'Out of Stock' => 'text-red-600 bg-red-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }
}
