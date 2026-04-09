<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'sku',
        'image',
    ];

    /**
     * Get the categories for the product.
     * Many-to-Many relationship
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Categories::class,
            'category_product',
            'product_id',
            'category_id'
        );
    }
}
