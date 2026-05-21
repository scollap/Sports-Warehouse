<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    protected $table = 'category';

    protected $primaryKey = 'categoryId';

    /**
    * get items for category
    *
    * @return HasMany
    */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'categoryId', 'categoryId');
    }
}
