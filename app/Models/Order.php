<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'status',
        'payment_method',
        'payment_status',
        'notes',
        'delivered_at',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'delivered_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * Relationship with Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $lastOrder = static::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastOrder ? (int) substr($lastOrder->order_number, -4) + 1 : 1;

        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get formatted total price in BDT
     */
    public function getFormattedTotalPriceAttribute(): string
    {
        return '৳' . number_format((float) $this->total_price, 2);
    }

    /**
     * Get formatted unit price in BDT
     */
    public function getFormattedUnitPriceAttribute(): string
    {
        return '৳' . number_format((float) $this->unit_price, 2);
    }

    /**
     * Get status label in Bengali
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'অপেক্ষমাণ',
            'confirmed' => 'নিশ্চিত',
            'processing' => 'প্রস্তুতিরত',
            'out_for_delivery' => 'ডেলিভারিতে',
            'delivered' => 'ডেলিভার্ড',
            'cancelled' => 'বাতিল',
            default => 'অজানা',
        };
    }

    /**
     * Get payment method label in Bengali
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'cash_on_delivery' => 'ক্যাশ অন ডেলিভারি',
            'mobile_banking' => 'মোবাইল ব্যাংকিং',
            default => 'অজানা',
        };
    }

    /**
     * Get payment status label in Bengali
     */
    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'pending' => 'অপেক্ষমাণ',
            'paid' => 'পরিশোধিত',
            'failed' => 'ব্যর্থ',
            default => 'অজানা',
        };
    }

    /**
     * Get status color class for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'out_for_delivery' => 'bg-orange-100 text-orange-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for today's orders
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope for this week's orders
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope for this month's orders
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }
}
