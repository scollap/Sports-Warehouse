<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
        protected $table = 'orders';

    protected $fillable = [
        'total_price',
        'customer_firstname',
        'customer_lastname',
        'customer_phone',
        'customer_email',
        'comments',
        'address',
        'card_name',
        'card_number',
        'card_expiry',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get all items for this order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
