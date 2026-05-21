<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{

    protected $table = 'item';

    protected $primaryKey = 'itemId';
    
    protected $fillable = [ 
        'itemName',
        'photo',
        'price',
        'salePrice',
        'description',
        'featured',
        'categoryId',
    ];

    /**
     * get categories for item
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
}
