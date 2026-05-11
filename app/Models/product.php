<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id',
        'category_id',
        'product_name',
        'product_price',
        'product_stock',
        'product_image',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
