<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\fileExists;

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
     * @return Attribute
     */
    public function imageUrl(): Attribute
    {
        return Attribute::get(function () {
        if ($this->photo && fileExists($this->photo)) 
            {
                        return asset('storage/' . $this->photo);
            }  
        return asset('placeholder.jpg');
        });
    }

    /**
     * Undocumented function
     *
     * @return Attribute
     */
    protected function isSaved(): Attribute
    {
        return Attribute::get(function () {
            $savedItems = Session::get('saved_items', []);
            return in_array($this->itemId, $savedItems);
        });
    }
}
