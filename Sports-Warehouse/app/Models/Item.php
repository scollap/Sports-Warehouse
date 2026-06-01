<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * get categories for item
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }

    // add to use when displaying images on pages
    public function imageUrl(): Attribute
    {
        return Attribute::get(function () {
        if ($this->photo && fileExists($this->photo)) 
            {
                        return asset('storage/' . $this->photo);
            }  
        return asset('storage/placeholder.jpg');
        });
    }
}
