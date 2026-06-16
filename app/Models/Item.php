<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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

    protected $casts = [
        'price' => 'decimal:2',
        'salePrice' => 'decimal:2',
        'featured' => 'boolean',
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

    /**
     * Get the image URL for the item.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->photo) {
            // Check public/images/product first
            if (File::exists(public_path('images/product/' . $this->photo))) {
                return asset('images/product/' . $this->photo);
            }
            // Check in storage
            if (File::exists(storage_path('app/public/' . $this->photo))) {
                return asset('storage/' . $this->photo);
            }
        }
        // Return placeholder if no image
        return asset('images/placeholder.png');
    }

    /**
     * Check if item is in the cart
     *
     * @return bool
     */
    public function getIsSavedAttribute()
    {
        $savedItems = Session::get('saved_items', []);
        return in_array($this->itemId, $savedItems);
    }
}
