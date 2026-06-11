<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
        protected $table = 'orders';

    protected $fillable = [
        'total_price',
        'customer_name',
        'customer_email',
        'comments',
        'address',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Get all items for this order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
