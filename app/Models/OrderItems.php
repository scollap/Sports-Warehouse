<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Parent order.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    /**
     * Product purchased.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(
            Item::class,
            'item_id',   // foreign key in order_items
            'itemId'     // primary key in item table
        );
    }
}
