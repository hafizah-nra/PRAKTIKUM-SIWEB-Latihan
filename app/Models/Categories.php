<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categories extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the products for the category.
     * Many-to-Many relationship
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            product::class,
            'category_product',
            'category_id',
            'product_id'
        );
    }
}
